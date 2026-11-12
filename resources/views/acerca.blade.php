<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de - Calendario Andino IA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans text-gray-800 flex h-screen overflow-hidden">

    <!-- MENÚ LATERAL (Sidebar) -->
    <aside class="w-64 bg-[#1b3a5c] text-white flex flex-col justify-between">
        <div>
            <div class="p-6 text-center border-b border-blue-800">
                <div class="text-4xl mb-2">🏔️</div>
                <h1 class="text-xl font-bold leading-tight">Calendario<br>Andino IA</h1>
                <p class="text-xs text-blue-200 mt-2 italic">"Siembra en el momento correcto, cosecha mejor"</p>
            </div>

            <nav class="mt-4 space-y-1 px-2">
                <a href="/" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition"><span>🏠</span> Inicio</a>
                <a href="/mis-parcelas" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition"><span>📍</span> Mis Parcelas</a>
                <a href="/pronostico" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition"><span>⛅</span> Pronóstico Climático</a>
                <a href="/recomendaciones" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition"><span>🌱</span> Recomendaciones</a>
                <a href="/noticias" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition"><span>📰</span> Noticias Agrícolas</a>
                <a href="/acerca-de" class="flex items-center gap-3 px-4 py-3 bg-blue-600 rounded-lg font-medium text-sm"><span>ℹ️</span> Acerca de</a>
            </nav>
        </div>
        <div class="p-4 text-center text-xs text-blue-200 italic border-t border-blue-800">
            "Nuestra tierra, nuestro futuro"
        </div>
    </aside>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="max-w-3xl">
            <h2 class="text-3xl font-bold mb-2 text-gray-800">Acerca del Sistema</h2>
            <p class="text-gray-600 mb-8">Conoce la tecnología detrás del Calendario Andino IA.</p>

            <!-- Introducción -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-2"><span class="text-green-600">🌱</span> ¿Qué es Calendario Andino IA?</h3>
                <p class="text-gray-600 leading-relaxed">
                    Es una plataforma inteligente diseñada para apoyar a los agricultores de la sierra peruana. Utiliza datos satelitales en tiempo real y modelos de Inteligencia Artificial para determinar las ventanas óptimas de siembra, reduciendo los riesgos por heladas, sequías o exceso de lluvia.
                </p>
            </div>

            <!-- Arquitectura del Sistema -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2"><span class="text-blue-600">⚙️</span> Arquitectura del Sistema</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border border-gray-100 bg-gray-50 p-4 rounded-lg">
                        <p class="font-bold text-gray-800 text-sm">1. Datos Satelitales (NASA)</p>
                        <p class="text-xs text-gray-600 mt-1">Consultamos las APIs de NASA POWER y SMAP para obtener temperatura, humedad y precipitación de la zona.</p>
                    </div>
                    <div class="border border-gray-100 bg-gray-50 p-4 rounded-lg">
                        <p class="font-bold text-gray-800 text-sm">2. Motor de Inteligencia Artificial</p>
                        <p class="text-xs text-gray-600 mt-1">Un microservicio desarrollado en Python (FastAPI) procesa los datos y genera la recomendación agronómica.</p>
                    </div>
                    <div class="border border-gray-100 bg-gray-50 p-4 rounded-lg">
                        <p class="font-bold text-gray-800 text-sm">3. Backend y Base de Datos</p>
                        <p class="text-xs text-gray-600 mt-1">Laravel (PHP) gestiona la lógica, las rutas y guarda el historial de evaluaciones en MySQL.</p>
                    </div>
                    <div class="border border-gray-100 bg-gray-50 p-4 rounded-lg">
                        <p class="font-bold text-gray-800 text-sm">4. Interfaz de Usuario</p>
                        <p class="text-xs text-gray-600 mt-1">Diseño responsivo y moderno construido con Tailwind CSS y Blade.</p>
                    </div>
                </div>
            </div>

            <!-- Tecnologías -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2"><span class="text-purple-600">💻</span> Tecnologías Utilizadas</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-red-50 text-red-700 px-3 py-1 rounded-full text-sm font-semibold border border-red-200">Laravel 13</span>
                    <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold border border-blue-200">PHP 8.5</span>
                    <span class="bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold border border-yellow-200">Python 3.15</span>
                    <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-semibold border border-green-200">FastAPI</span>
                    <span class="bg-orange-50 text-orange-700 px-3 py-1 rounded-full text-sm font-semibold border border-orange-200">MySQL 8</span>
                    <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-full text-sm font-semibold border border-teal-200">Tailwind CSS</span>
                    <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold border border-indigo-200">NASA POWER API</span>
                </div>
                <p class="text-sm text-gray-500 mt-6 border-t pt-4 text-center">Desarrollado con fines académicos y tecnológicos.</p>
            </div>
        </div>
    </main>

</body>
</html>
