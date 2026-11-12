<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParcelaController;
use App\Services\NasaService;

// 1. Ruta principal (Dashboard con datos reales de la NASA)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// 2. Ruta de prueba de base de datos
Route::get('/prueba-db', [UsuarioController::class, 'index']);

// 3. Ruta de prueba para conectar con la NASA
Route::get('/test-nasa', function (NasaService $nasa) {
    $data = $nasa->getClimateData(-15.3700, -73.6950);
    if (!$data) {
        return "Error al conectar con la NASA.";
    }
    return response()->json($data);
});

// 4. Rutas de Mis Parcelas (Formulario y Guardado)
Route::get('/mis-parcelas', [ParcelaController::class, 'create']);
Route::post('/guardar-parcela', [ParcelaController::class, 'store']);

// 5. Rutas de las secciones del menú (Ahora conectadas al Controlador)
Route::get('/pronostico', [DashboardController::class, 'pronostico'])->name('pronostico');

Route::get('/recomendaciones', [DashboardController::class, 'recomendaciones'])->name('recomendaciones');

Route::get('/noticias', function () {
    return view('noticias');
})->name('noticias');

Route::get('/acerca-de', function () {
    return view('acerca');
})->name('acerca');
