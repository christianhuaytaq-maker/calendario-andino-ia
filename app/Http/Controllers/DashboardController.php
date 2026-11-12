<?php

namespace App\Http\Controllers;

use App\Services\NasaService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(NasaService $nasa)
    {
        // 1. BUSCAMOS LA ÚLTIMA PARCELA REGISTRADA EN LA BASE DE DATOS
        $parcela = DB::table('parcelas')->orderBy('id', 'desc')->first();

        // 2. Si existe una parcela, usamos SUS datos (lat, lon, area, nombre)
        if ($parcela) {
            $lat = $parcela->latitud;
            $lon = $parcela->longitud;
            $area_hectareas = $parcela->area_hectareas;
            $nombreParcela = $parcela->nombre;
            // Extraemos el distrito de la descripción (ej: "Parcela en Coracora...")
            $partes = explode('.', $parcela->descripcion);
            $descripcionParcela = $partes[0];
        } else {
            // Si la base de datos está vacía, usamos Coracora por defecto
            $lat = -15.3700;
            $lon = -73.6950;
            $area_hectareas = 1.0;
            $nombreParcela = "Parcela Coracora";
            $descripcionParcela = "Distrito: Coracora";
        }

        // 3. Pedimos los datos de la NASA para las coordenadas de ESA PARCELA
        $datosNasa = $nasa->getClimateData($lat, $lon);

        $temperaturaReal = 0;
        $lluviaReal = 0;
        $humedadReal = 68;
        $graficoClima = [];

        if ($datosNasa && isset($datosNasa['properties']['parameter'])) {
            $parametros = $datosNasa['properties']['parameter'];
            $temps = $parametros['T2M'];
            $lluvias = $parametros['PRECTOTCORR'];
            $fechas = array_keys($temps);

            // Filtramos los datos erróneos de la NASA (-999)
            $tempsValidas = array_filter($temps, function($valor) { return $valor > -900; });
            $lluviasValidas = array_filter($lluvias, function($valor) { return $valor > -900; });

            if (count($tempsValidas) > 0) {
                $temperaturaReal = round(array_sum($tempsValidas) / count($tempsValidas), 1);
            }
            if (count($lluviasValidas) > 0) {
                $lluviaReal = round(array_sum($lluviasValidas), 1);
            }

            // Preparamos los últimos 7 días para el gráfico
            $ultimos7Dias = array_slice($fechas, -7, 7, true);
            $diasSemana = ['Mon' => 'Lun', 'Tue' => 'Mar', 'Wed' => 'Mié', 'Thu' => 'Jue', 'Fri' => 'Vie', 'Sat' => 'Sáb', 'Sun' => 'Dom'];

            foreach ($ultimos7Dias as $fecha) {
                if ($temps[$fecha] > -900) {
                    $diaIngles = Carbon::parse($fecha)->format('D');
                    $diaEspanol = $diasSemana[$diaIngles] ?? $diaIngles;

                    $graficoClima[] = [
                        'dia' => $diaEspanol,
                        'temp' => round($temps[$fecha], 1)
                    ];
                }
            }
        }

        // 4. Consultamos a Python (IA) con el ÁREA REAL del terreno
        $prediccionIA = $nasa->predecirSiembra($temperaturaReal, $lluviaReal, $humedadReal, $area_hectareas);

        // 5. Guardamos la recomendación en el historial
        try {
            DB::table('recomendaciones')->insert([
                'parcela_id' => $parcela ? $parcela->id : 1,
                'cultivo_id' => 1,
                'fecha_evaluacion' => now(),
                'fecha_siembra_desde' => '2026-11-15',
                'fecha_siembra_hasta' => '2026-11-25',
                'nivel_confianza' => $prediccionIA['nivel_confianza'],
                'riesgo_sequia' => 'bajo',
                'riesgo_helada' => 'bajo',
                'recomendacion' => $prediccionIA['recomendacion'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) { }

        // 6. Generamos el calendario de Noviembre
        $mesCalendario = 11;
        $anioCalendario = 2026;
        $diasEnElMes = cal_days_in_month(CAL_GREGORIAN, $mesCalendario, $anioCalendario);
        $primerDiaSemana = Carbon::create($anioCalendario, $mesCalendario, 1)->dayOfWeekIso;
        $diasCalendario = array_fill(0, $primerDiaSemana - 1, null);
        for ($i = 1; $i <= $diasEnElMes; $i++) { $diasCalendario[] = $i; }

        // 7. Enviamos TODOS los datos a la vista
        return view('dashboard', compact(
            'temperaturaReal', 'lluviaReal', 'humedadReal',
            'prediccionIA', 'diasCalendario', 'mesCalendario',
            'anioCalendario', 'graficoClima', 'area_hectareas',
            'nombreParcela', 'descripcionParcela', 'lat', 'lon'
        ));
    }

    public function pronostico(NasaService $nasa)
    {
        $parcela = DB::table('parcelas')->orderBy('id', 'desc')->first();
        $lat = $parcela ? $parcela->latitud : -15.3700;
        $lon = $parcela ? $parcela->longitud : -73.6950;

        $datos = $nasa->getClimateData($lat, $lon);
        $pronosticos = [];
        if ($datos && isset($datos['properties']['parameter'])) {
            $temps = $datos['properties']['parameter']['T2M'];
            $lluvias = $datos['properties']['parameter']['PRECTOTCORR'];
            foreach (array_keys($temps) as $fecha) {
                if ($temps[$fecha] > -900) {
                    $pronosticos[] = ['fecha' => $fecha, 'temperatura' => round($temps[$fecha], 1), 'lluvia' => round($lluvias[$fecha], 1)];
                }
            }
        }
        return view('pronostico', compact('pronosticos'));
    }

    public function recomendaciones()
    {
        $historial = DB::table('recomendaciones')->orderBy('fecha_evaluacion', 'desc')->limit(10)->get();
        return view('recomendaciones', compact('historial'));
    }
}
