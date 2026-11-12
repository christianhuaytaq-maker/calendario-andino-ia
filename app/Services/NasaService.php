<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NasaService
{
    public function getClimateData($lat, $lon)
    {
        $url = "https://power.larc.nasa.gov/api/temporal/daily/point";

        try {
            // Aumentamos el tiempo de espera a 15 segundos por si la NASA está lenta
            $response = Http::timeout(15)->get($url, [
                'parameters' => 'T2M,PRECTOTCORR',
                'community' => 'AG',
                'longitude' => $lon,
                'latitude' => $lat,
                'start' => '20261101',
                'end' => '20261111',
                'format' => 'JSON',
            ]);

            if ($response->successful()) {
                return $response->json();
            }

        } catch (\Exception $e) {
            // Si la NASA falla o no hay internet, devolvemos datos de respaldo
            // para que el sistema NO se caiga.
            return $this->datosRespaldo();
        }

        return $this->datosRespaldo();
    }

    /**
     * Datos de respaldo en caso de que la NASA no responda
     */
    private function datosRespaldo()
    {
        // Simulamos una respuesta estructurada como la de la NASA
        return [
            'properties' => [
                'parameter' => [
                    'T2M' => [
                        '20261101' => 14.5, '20261102' => 15.2, '20261103' => 13.8,
                        '20261104' => 16.1, '20261105' => 14.9, '20261106' => 15.5,
                        '20261107' => 14.2, '20261108' => 15.8, '20261109' => 16.0,
                        '20261110' => 14.7, '20261111' => 15.3,
                    ],
                    'PRECTOTCORR' => [
                        '20261101' => 12.5, '20261102' => 8.2, '20261103' => 15.0,
                        '20261104' => 5.5, '20261105' => 10.0, '20261106' => 7.5,
                        '20261107' => 20.0, '20261108' => 6.0, '20261109' => 4.5,
                        '20261110' => 11.0, '20261111' => 9.8,
                    ]
                ]
            ]
        ];
    }

    public function predecirSiembra($temperatura, $lluvia, $humedad, $area_hectareas = 1.0)
    {
        try {
            $response = Http::timeout(10)->post('http://127.0.0.1:8001/predecir', [
                'temperatura' => $temperatura,
                'lluvia' => $lluvia,
                'humedad' => $humedad,
                'area_hectareas' => $area_hectareas
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            return [
                "recomendacion" => "Error en el servidor de IA.",
                "nivel_confianza" => 0,
                "fase_lunar" => "Desconocida",
                "consejo_lunar" => "",
                "semilla_necesaria" => ["papa_kg" => 0, "maiz_kg" => 0]
            ];

        } catch (\Exception $e) {
            return [
                "recomendacion" => "No se pudo conectar con el motor de IA. ¿Está encendido Python?",
                "nivel_confianza" => 0,
                "fase_lunar" => "Desconocida",
                "consejo_lunar" => "",
                "semilla_necesaria" => ["papa_kg" => 0, "maiz_kg" => 0]
            ];
        }
    }
}
