<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario Andino IA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans text-gray-800">
    <div class="flex h-screen overflow-hidden">

        <!-- MENÚ LATERAL (Sidebar) -->
        <aside class="w-64 bg-[#1b3a5c] text-white flex flex-col justify-between flex-shrink-0">
            <div>
                <div class="p-6 text-center border-b border-blue-800 flex flex-col items-center">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mb-2 overflow-hidden border-2 border-green-400">
                        <span class="text-4xl">🏔️</span>
                    </div>
                    <h1 class="text-xl font-bold leading-tight">Calendario<br>Andino IA</h1>
                    <p class="text-xs text-blue-200 mt-2 italic">"Siembra en el momento correcto, cosecha mejor"</p>
                </div>

                <nav class="mt-4 space-y-1 px-2">
                    <a href="/" class="flex items-center gap-3 px-4 py-3 bg-blue-600 rounded-lg font-medium text-sm">
                        <span>🏠</span> Inicio
                    </a>
                    <a href="/mis-parcelas" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition">
                        <span>📍</span> Mis Parcelas
                    </a>
                    <a href="/pronostico" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition">
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

            <!-- Imagen decorativa al final del menú -->
            <div class="relative h-48 w-full overflow-hidden">
                <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover opacity-70" alt="Montaña">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                    <p class="text-white text-sm italic font-serif text-center px-4">"Nuestra tierra, nuestro futuro"</p>
                </div>
            </div>
        </aside>

        <!-- CONTENIDO PRINCIPAL -->
        <main class="flex-1 flex flex-col overflow-y-auto bg-gray-100">

            <!-- ENCABEZADO SUPERIOR (Banner con foto) -->
            <header class="relative bg-white shadow-sm h-36 flex items-center px-8 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80" class="absolute inset-0 w-full h-full object-cover" alt="Fondo Andino">

                <div class="absolute inset-0 bg-black bg-opacity-30"></div>

                <div class="relative z-10 w-full flex justify-between items-center">
                    <div class="bg-black bg-opacity-50 px-6 py-3 rounded-xl backdrop-blur-sm border border-gray-600">
                        <h2 class="text-3xl font-bold text-white drop-shadow-md">Calendario Andino IA</h2>
                        <p class="text-sm text-gray-200 drop-shadow">Predicción inteligente para la agricultura andina</p>
                    </div>
                    <div class="flex items-center gap-3 bg-green-700 bg-opacity-90 px-5 py-2 rounded-full shadow-lg border border-green-500">
                        <p class="text-sm font-bold text-white">Fermín Huayta</p>
                        <div class="w-8 h-8 bg-white text-green-700 rounded-full flex items-center justify-center font-bold">
                            FH
                        </div>
                    </div>
                </div>
            </header>

            <!-- ÁREA DE TARJETAS -->
            <div class="p-6 pb-0 grid grid-cols-1 lg:grid-cols-12 gap-5">

                <!-- COLUMNA 1: MI PARCELA Y DATOS NASA -->
                <div class="lg:col-span-8 flex flex-col gap-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Tarjeta Mi Parcela (DINÁMICA) -->
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="font-bold text-gray-700 flex items-center gap-2"><span class="text-green-600">📍</span> Mi Parcela</h3>
                                <a href="/mis-parcelas" class="bg-green-700 text-white text-xs px-3 py-1 rounded-full hover:bg-green-800">Cambiar ubicación</a>
                            </div>
                            <div class="flex gap-3">
                                <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=200&q=80" class="w-28 h-24 object-cover rounded-lg" alt="Parcela">
                                <div class="text-xs text-gray-600 space-y-1 mt-1">
                                    <p><strong>Nombre:</strong> {{ $nombreParcela }}</p>
                                    <p><strong>Área:</strong> <span class="font-bold text-green-700">{{ $area_hectareas }} hectáreas</span></p>
                                    <p><strong>Ubicación:</strong> {{ $distrito ?? 'Coracora' }}</p>
                                    <p><strong>Coordenadas:</strong> {{ number_format($lat, 4) }}, {{ number_format($lon, 4) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Datos NASA -->
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                            <h3 class="font-bold text-gray-700 flex items-center gap-2 mb-3"><span class="text-blue-600">📡</span> Datos Satelitales (NASA)</h3>
                            <div class="grid grid-cols-3 gap-1 text-center text-sm">
                                <div>
                                    <div class="text-2xl text-blue-400">💧</div>
                                    <p class="text-[10px] text-gray-500 mt-1 leading-tight">Humedad del suelo (SMAP)</p>
                                    <p class="font-bold text-lg text-gray-800 mt-1">{{ $humedadReal }}%</p>
                                    <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full inline-block mt-1">Adecuada</span>
                                </div>
                                <div>
                                    <div class="text-2xl text-red-400">🌡️</div>
                                    <p class="text-[10px] text-gray-500 mt-1 leading-tight">Temperatura media (POWER)</p>
                                    <p class="font-bold text-lg text-gray-800 mt-1">{{ $temperaturaReal }} °C</p>
                                </div>
                                <div>
                                    <div class="text-2xl text-blue-600">🌧️</div>
                                    <p class="text-[10px] text-gray-500 mt-1 leading-tight">Precipitación (prevista)</p>
                                    <p class="font-bold text-lg text-gray-800 mt-1">{{ $lluviaReal }} mm</p>
                                </div>
                            </div>
                            <div class="mt-3 text-[10px] text-center text-gray-500 border-t pt-1">
                                <span class="text-green-600">✔</span> Datos actualizados: Hoy
                            </div>
                        </div>
                    </div>

                    <!-- Recomendación de Siembra -->
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                        <div class="bg-green-700 text-white p-3 rounded-t-lg -mt-5 -mx-5 mb-4 flex items-center gap-2">
                            <span>🌱</span> <h3 class="font-bold">Recomendación de Siembra</h3>
                        </div>

                        <div class="flex flex-col md:flex-row gap-4 items-center">
                            <div class="text-center md:text-left flex-1">
                                <div class="flex items-center gap-2 mb-3 justify-center md:justify-start">
                                    <span class="text-4xl text-green-600">✔️</span>
                                    <h4 class="text-lg font-bold text-gray-800 leading-tight">{{ $prediccionIA['recomendacion'] }}</h4>
                                </div>
                                <p class="text-xs text-gray-600 mb-1"><strong>Ventana recomendada:</strong></p>
                                <p class="bg-green-100 text-green-800 font-semibold px-3 py-2 rounded-lg inline-block mb-3 text-sm">📅 Del 15 al 25 de Noviembre de 2026</p>

                                <!-- FASE LUNAR REAL -->
                                <p class="text-xs text-gray-600 mb-1 mt-3"><strong>Fase Lunar de hoy:</strong></p>
                                <div class="bg-blue-50 border border-blue-200 text-blue-800 text-xs p-2 rounded-lg inline-block mb-3">
                                    🌙 <strong>{{ $prediccionIA['fase_lunar'] ?? 'Calculando...' }}</strong>: {{ $prediccionIA['consejo_lunar'] ?? '' }}
                                </div>

                                <!-- CÁLCULO DE SEMILLA -->
                                <p class="text-xs text-gray-600 mb-1 mt-3"><strong>Cálculo de semilla para {{ $area_hectareas }} ha:</strong></p>
                                <div class="bg-orange-50 border border-orange-200 text-orange-800 text-xs p-2 rounded-lg inline-block mb-3">
                                    🌱 Papa: <strong>{{ $prediccionIA['semilla_necesaria']['papa_kg'] ?? '0' }} kg</strong> |
                                    🌽 Maíz: <strong>{{ $prediccionIA['semilla_necesaria']['maiz_kg'] ?? '0' }} kg</strong>
                                </div>

                                <div class="flex items-center gap-2 justify-center md:justify-start">
                                    <p class="text-xs text-gray-600">Nivel de confianza:</p>
                                    <div class="w-32 bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ $prediccionIA['nivel_confianza'] }}%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-800">{{ $prediccionIA['nivel_confianza'] }}%</span>
                                </div>
                            </div>

                            <div class="flex flex-col items-center">
                                <p class="text-xs font-bold text-gray-600 mb-2">Cultivos recomendados:</p>
                                <div class="flex gap-3 text-center">
                                    <div>
                                        <img src="https://images.unsplash.com/photo-1518977676601-b53f82aba655?auto=format&fit=crop&w=100&q=80" class="w-14 h-14 rounded-full object-cover mx-auto border-2 border-green-200" alt="Papa">
                                        <p class="text-xs font-bold mt-1">Papa</p>
                                    </div>
                                    <div>
                                        <img src="https://images.unsplash.com/photo-1551754655-cd27e38d2076?auto=format&fit=crop&w=100&q=80" class="w-14 h-14 rounded-full object-cover mx-auto border-2 border-green-200" alt="Maíz">
                                        <p class="text-xs font-bold mt-1">Maíz</p>
                                    </div>
                                    <div>
                                        <img src="https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=100&q=80" class="w-14 h-14 rounded-full object-cover mx-auto border-2 border-green-200" alt="Quinua">
                                        <p class="text-xs font-bold mt-1">Quinua</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Barra de riesgos -->
                        <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-2 flex justify-between items-center text-xs">
                            <p class="text-yellow-800"><span class="text-yellow-600 font-bold">⚠</span> Riesgo de heladas: Bajo (> 3 °C) | Riesgo de sequía: Bajo</p>
                            <p class="text-green-700 font-bold flex items-center gap-1"><span class="text-green-500">✔</span> Condiciones favorables</p>
                        </div>
                    </div>
                </div>

                <!-- COLUMNA 2: CALENDARIO E INFO -->
                <div class="lg:col-span-4 flex flex-col gap-5">

                    <!-- Calendario -->
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                        <h3 class="font-bold text-gray-700 flex items-center gap-2 mb-3"><span class="text-blue-800">📅</span> Calendario Agrícola</h3>
                        <div class="text-center font-bold text-gray-800 mb-2 text-sm">Noviembre 2026</div>

                        <div class="grid grid-cols-7 gap-1 text-center text-[10px] font-semibold text-gray-500 mb-1">
                            <div>Do</div><div>Lu</div><div>Ma</div><div>Mi</div><div>Ju</div><div>Vi</div><div>Sá</div>
                        </div>

                        <div class="grid grid-cols-7 gap-1 text-center text-xs">
                            @foreach($diasCalendario as $dia)
                                @if($dia === null)
                                    <div></div>
                                @else
                                    @if($dia >= 15 && $dia <= 25)
                                        <div class="py-1 rounded-sm bg-green-100 text-green-800 font-bold">{{ $dia }}</div>
                                    @else
                                        <div class="py-1 text-gray-700">{{ $dia }}</div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Info Cultivo -->
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                        <div class="bg-purple-700 text-white p-2 rounded-t-lg -mt-4 -mx-4 mb-3 flex items-center gap-2">
                            <span>ℹ️</span> <h3 class="font-bold text-sm">Información del Cultivo</h3>
                        </div>
                        <div class="flex gap-3 items-center">
                            <img src="https://images.unsplash.com/photo-1518977676601-b53f82aba655?auto=format&fit=crop&w=100&q=80" class="w-14 h-14 rounded-lg object-cover" alt="Papa">
                            <div class="text-xs">
                                <p class="font-bold text-gray-800 text-sm">Papa</p>
                                <p class="text-green-600 mt-1">✔️ Temp. ideal: 8 - 18 °C</p>
                                <p class="text-green-600">✔️ Lluvia ideal: 500 - 800 mm</p>
                                <p class="text-green-600">✔️ Días a cosecha: 90 - 120</p>
                            </div>
                        </div>
                        <button class="w-full mt-3 text-xs font-semibold text-purple-700 border border-purple-200 rounded-lg py-1.5 hover:bg-purple-50 transition">Ver más detalles →</button>
                    </div>
                </div>
            </div>

            <!-- NUEVA FILA INFERIOR: Pronóstico, Consejos y Alertas -->
            <div class="p-6 grid grid-cols-1 lg:grid-cols-12 gap-5">

                <!-- 1. Gráfico de Pronóstico DINÁMICO -->
                <div class="lg:col-span-4 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                    <div class="bg-[#1b3a5c] text-white p-2.5 flex items-center gap-2">
                        <span>📈</span> <h3 class="font-bold text-sm">Pronóstico Climático (7 días)</h3>
                    </div>
                    <div class="p-4 flex-1 flex flex-col justify-center">
                        <div class="relative h-24 w-full flex items-end justify-between px-2 mb-2">
                            <div class="absolute bottom-4 left-0 w-full h-0.5 bg-gray-200"></div>

                            @forelse($graficoClima as $dato)
                                <div class="relative z-10 flex flex-col items-center">
                                    <span class="text-xs font-bold text-gray-700 mb-1">{{ $dato['temp'] }}°C</span>
                                    <div class="w-3 h-3 bg-orange-500 rounded-full border-2 border-white shadow"></div>
                                    <span class="text-[10px] text-gray-600 mt-1 capitalize">{{ $dato['dia'] }}</span>
                                </div>
                            @empty
                                <div class="text-xs text-gray-500 w-full text-center">Sin datos del clima</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- 2. Consejos para el Agricultor -->
                <div class="lg:col-span-4 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-green-700 text-white p-2.5 flex items-center gap-2">
                        <span>🌱</span> <h3 class="font-bold text-sm">Consejos para el Agricultor</h3>
                    </div>
                    <div class="p-4 flex items-start gap-3">
                        <div class="text-4xl text-yellow-500 bg-yellow-50 p-2 rounded-full">💡</div>
                        <ul class="text-xs text-gray-700 space-y-2 mt-1">
                            <li class="flex items-center gap-2"><span class="text-green-600 font-bold">✔️</span> Prepare el terreno con anticipación.</li>
                            <li class="flex items-center gap-2"><span class="text-green-600 font-bold">✔️</span> Use semillas de buena calidad.</li>
                            <li class="flex items-center gap-2"><span class="text-green-600 font-bold">✔️</span> Aproveche la humedad del suelo.</li>
                        </ul>
                    </div>
                </div>

                <!-- 3. Alertas Importantes -->
                <div class="lg:col-span-4 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-[#1b3a5c] text-white p-2.5 flex items-center gap-2">
                        <span>🔔</span> <h3 class="font-bold text-sm">Alertas Importantes</h3>
                    </div>
                    <div class="p-4 flex items-start gap-3">
                        <div class="text-blue-500 text-2xl mt-1">ℹ️</div>
                        <div class="text-xs text-gray-700">
                            <p class="font-semibold text-blue-900 mb-1">Aviso Climático</p>
                            <p>En los próximos días se esperan lluvias moderadas en la zona. Aproveche para sembrar.</p>
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>
</body>
</html>
