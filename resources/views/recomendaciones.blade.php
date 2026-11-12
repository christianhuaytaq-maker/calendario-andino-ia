<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recomendaciones - Calendario Andino IA</title>
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
                <a href="/recomendaciones" class="flex items-center gap-3 px-4 py-3 bg-blue-600 rounded-lg font-medium text-sm"><span>🌱</span> Recomendaciones</a>
                <a href="/noticias" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition"><span>📰</span> Noticias Agrícolas</a>
                <a href="/acerca-de" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition"><span>ℹ️</span> Acerca de</a>
            </nav>
        </div>
        <div class="p-4 text-center text-xs text-blue-200 italic border-t border-blue-800">
            "Nuestra tierra, nuestro futuro"
        </div>
    </aside>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="flex-1 p-8 overflow-y-auto">
        <h2 class="text-2xl font-bold mb-6">Historial de Recomendaciones (Base de Datos)</h2>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 text-sm">
                    <tr>
                        <th class="p-4 border-b">Fecha de Evaluación</th>
                        <th class="p-4 border-b">Recomendación de la IA</th>
                        <th class="p-4 border-b">Nivel de Confianza</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($historial as $item)
                        <tr class="hover:bg-gray-50 text-sm transition">
                            <td class="p-4 border-b text-gray-700">{{ $item->fecha_evaluacion }}</td>
                            <td class="p-4 border-b text-gray-800 font-medium">{{ $item->recomendacion }}</td>
                            <td class="p-4 border-b">
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-bold text-xs">
                                    {{ $item->nivel_confianza }}%
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-8 text-center text-gray-500">
                                <div class="text-4xl mb-2">📭</div>
                                Aún no hay recomendaciones guardadas. <br>
                                <a href="/" class="text-blue-600 hover:underline mt-2 inline-block">Ve al Inicio para generar una nueva evaluación.</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
