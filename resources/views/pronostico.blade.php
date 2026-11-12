<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pronóstico Climático - Calendario Andino IA</title>
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
                <a href="/" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition">
                    <span>🏠</span> Inicio
                </a>
                <a href="/mis-parcelas" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition">
                    <span>📍</span> Mis Parcelas
                </a>
                <a href="/pronostico" class="flex items-center gap-3 px-4 py-3 bg-blue-600 rounded-lg font-medium text-sm">
                    <span>⛅</span> Pronóstico Climático
                </a>
                <a href="/recomendaciones" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition">
                    <span>🌱</span> Recomendaciones
                </a>
                <a href="/noticias" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition">
                    <span>📰</span> Noticias Agrícolas
                </a>
                <a href="/acerca-de" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition">
                    <span>ℹ️</span> Acerca de
                </a>
            </nav>
        </div>
        <div class="p-4 text-center text-xs text-blue-200 italic border-t border-blue-800">
            "Nuestra tierra, nuestro futuro"
        </div>
    </aside>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="flex-1 p-8 overflow-y-auto">
        <h2 class="text-2xl font-bold mb-6">Pronóstico Climático (Datos NASA POWER)</h2>

        <!-- TARJETAS DEL CLIMA -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($pronosticos as $dia)
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 text-center">
                    <p class="text-gray-500 font-bold mb-2">{{ $dia['fecha'] }}</p>
                    <div class="text-3xl text-red-400 mb-2">🌡️</div>
                    <p class="text-2xl font-bold text-gray-800">{{ $dia['temperatura'] }} °C</p>
                    <div class="text-3xl text-blue-500 mt-4 mb-2">🌧️</div>
                    <p class="text-lg font-bold text-gray-800">{{ $dia['lluvia'] }} mm</p>
                </div>
            @empty
                <div class="col-span-4 bg-white p-6 rounded-xl shadow-sm border border-gray-200 text-center text-gray-500">
                    No hay datos disponibles en este momento.
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>
