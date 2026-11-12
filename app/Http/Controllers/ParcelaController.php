<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParcelaController extends Controller
{
    public function create()
    {
        return view('parcelas');
    }

    public function store(Request $request)
    {
        try {
            // Si el JS no envía el área, calculamos un valor por defecto.
            // Pero si llega, la usamos.
            $area = $request->area_hectareas ?? 1.0;
            $perimetro = $request->perimetro_metros ?? 0;
            $lat = $request->latitud ?? '-15.3700';
            $lon = $request->longitud ?? '-73.6950';

            DB::table('parcelas')->insert([
                'agricultor_id' => 1,
                'comunidad_id' => 1,
                'nombre' => $request->nombre,
                'latitud' => $lat,
                'longitud' => $lon,
                'altitud_msnm' => 3320,
                'area_hectareas' => $area,
                'descripcion' => 'Parcela en ' . $request->distrito . '. Perímetro: ' . $perimetro . ' metros.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect('/')->with('success', '¡Parcela guardada con éxito!');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }
}
