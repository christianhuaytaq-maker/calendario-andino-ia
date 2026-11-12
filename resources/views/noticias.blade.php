<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias Agrícolas - Calendario Andino IA</title>
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
                <a href="/noticias" class="flex items-center gap-3 px-4 py-3 bg-blue-600 rounded-lg font-medium text-sm"><span>📰</span> Noticias Agrícolas</a>
                <a href="/acerca-de" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition"><span>ℹ️</span> Acerca de</a>
            </nav>
        </div>
        <div class="p-4 text-center text-xs text-blue-200 italic border-t border-blue-800">
            "Nuestra tierra, nuestro futuro"
        </div>
    </aside>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="flex-1 p-8 overflow-y-auto">
        <h2 class="text-2xl font-bold mb-6">Noticias Agrícolas</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Noticia 1 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                <img src="https://images.unsplash.com/photo-1592982537447-7440770cbfc9?auto=format&fit=crop&w=600&q=80" class="w-full h-48 object-cover" alt="Papa">
                <div class="p-5 flex-1 flex flex-col">
                    <span class="text-xs font-bold text-green-600 uppercase tracking-wide mb-2">Cultivos Andinos</span>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Nuevas variedades de papa resistentes a heladas</h3>
                    <p class="text-sm text-gray-600 mb-4 flex-1">Investigadores del INIA han desarrollado nuevas variedades de papa que soportan temperaturas extremas, ideales para las zonas altoandinas de Ayacucho.</p>
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition">Leer más →</a>
                </div>
            </div>

            <!-- Noticia 2 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?auto=format&fit=crop&w=600&q=80" class="w-full h-48 object-cover" alt="Agricultor">
                <div class="p-5 flex-1 flex flex-col">
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-wide mb-2">Tecnología</span>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">El uso de drones en la agricultura de precisión</h3>
                    <p class="text-sm text-gray-600 mb-4 flex-1">El monitoreo satelital y los drones están ayudando a los agricultores de Parinacochas a optimizar el riego y detectar plagas a tiempo.</p>
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition">Leer más →</a>
                </div>
            </div>

            <!-- Noticia 3 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                <img src="https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=600&q=80" class="w-full h-48 object-cover" alt="Quinua">
                <div class="p-5 flex-1 flex flex-col">
                    <span class="text-xs font-bold text-yellow-600 uppercase tracking-wide mb-2">Mercados</span>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Precios de la quinua en alza para esta campaña</h3>
                    <p class="text-sm text-gray-600 mb-4 flex-1">Los mercados internacionales muestran un incremento en la demanda de quinua peruana, beneficiando a los productores de la sierra sur.</p>
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition">Leer más →</a>
                </div>
            </div>

            <!-- Noticia 4 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?auto=format&fit=crop&w=600&q=80" class="w-full h-48 object-cover" alt="Clima">
                <div class="p-5 flex-1 flex flex-col">
                    <span class="text-xs font-bold text-red-600 uppercase tracking-wide mb-2">Clima</span>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Pronóstico de lluvias favorable para la sierra</h3>
                    <p class="text-sm text-gray-600 mb-4 flex-1">El SENAMHI anuncia precipitaciones moderadas para las próximas semanas, lo que favorecerá el inicio de la campaña de siembra.</p>
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition">Leer más →</a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
