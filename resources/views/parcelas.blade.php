<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Parcelas - Calendario Andino IA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />

    <style>
        #map { height: 500px; width: 100%; border-radius: 0.5rem; z-index: 1; cursor: crosshair; }
        .search-container {
            position: absolute; top: 20px; left: 50px; z-index: 1000;
            width: 350px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem; background: white;
        }
        .area-info {
            position: absolute; bottom: 20px; right: 20px; z-index: 1000;
            background: white; padding: 10px 15px; border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            font-weight: bold; color: #166534; display: none; text-align: right;
            border: 2px solid #22c55e;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-800 flex h-screen overflow-hidden">

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 mx-8 mt-4 z-50" role="alert">
            <strong class="font-bold">¡Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <aside class="w-64 bg-[#1b3a5c] text-white flex flex-col justify-between flex-shrink-0">
        <div>
            <div class="p-6 text-center border-b border-blue-800 flex flex-col items-center">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mb-2 overflow-hidden border-2 border-green-400">
                    <span class="text-4xl">🏔️</span>
                </div>
                <h1 class="text-xl font-bold leading-tight">Calendario<br>Andino IA</h1>
            </div>
            <nav class="mt-4 space-y-1 px-2">
                <a href="/" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-800 rounded-lg text-sm transition">
                    <span>🏠</span> Inicio
                </a>
                <a href="/mis-parcelas" class="flex items-center gap-3 px-4 py-3 bg-blue-600 rounded-lg font-medium text-sm">
                    <span>📍</span> Mis Parcelas
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        <div class="max-w-5xl mx-auto">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Registrar Nueva Parcela</h1>
                <p class="text-blue-600 font-bold text-sm mt-1 bg-blue-50 p-2 rounded inline-block">
                    👉 Instrucciones: Busca tu distrito, dibuja el terreno con el pentágono (clic en cada esquina y doble clic al final) y presiona Guardar.
                </p>
            </div>

            <form action="/guardar-parcela" method="POST" id="formParcela">
                @csrf
                <div class="relative mb-6">
                    <div id="map" class="border border-gray-300 shadow-inner"></div>

                    <div class="search-container">
                        <div class="flex">
                            <input type="text" id="buscador" class="flex-1 p-3 rounded-l-lg focus:outline-none text-sm" placeholder="🔍 Buscar distrito o ciudad (Ej: Coracora)">
                            <button type="button" onclick="buscarLugar()" class="bg-blue-600 text-white px-4 rounded-r-lg hover:bg-blue-700 transition">Ir</button>
                        </div>
                    </div>

                    <div id="area-display" class="area-info">
                        📏 Área: <span id="area-value">0</span> ha<br>
                        📐 Perímetro: <span id="perimetro-value">0</span> m
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Nombre de la Parcela:</label>
                            <input type="text" id="nombre_parcela" name="nombre" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Ej: Parcela Norte" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Distrito:</label>
                            <input type="text" id="distrito_parcela" name="distrito" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Ej: Coracora" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Latitud (Centro):</label>
                            <input type="text" id="latitud" name="latitud" class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2 text-sm text-gray-600" readonly required>
                        </div>
                        <div>
                            <label class="block text-gray-600 text-sm mb-1">Longitud (Centro):</label>
                            <input type="text" id="longitud" name="longitud" class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2 text-sm text-gray-600" readonly required>
                        </div>
                    </div>

                    <input type="hidden" id="area_hectareas" name="area_hectareas" value="0">
                    <input type="hidden" id="perimetro_metros" name="perimetro_metros" value="0">

                    <button type="submit" class="w-full bg-green-700 text-white font-bold py-3 rounded-lg hover:bg-green-800 transition text-lg">
                        Guardar Parcela en Base de Datos
                    </button>
                </div>
            </form>
            <a href="/" class="inline-block mt-4 text-blue-600 hover:underline">← Volver al Inicio</a>
        </div>
    </main>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.js"></script>

    <script>
        var map = L.map('map', { maxZoom: 22 }).setView([-15.3700, -73.6950], 13);

        var satelital = L.tileLayer('https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            attribution: '&copy; Google Maps', maxZoom: 22
        }).addTo(map);

        var calles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        });

        L.control.layers({ "Satélite": satelital, "Calles": calles }, null, { position: 'topright' }).addTo(map);

        map.pm.addControls({
            position: 'topleft',
            drawMarker: false, drawCircle: false, drawCircleMarker: false,
            drawPolyline: false, drawRectangle: false,
            drawPolygon: true, editMode: true, dragMode: false, cutPolygon: false, removalMode: true,
        });

        // Esta es la función que hace TODO el cálculo
        function calcularTodo(layer) {
            if (!layer) return;

            var latlngs = layer.getLatLngs()[0];
            if (!latlngs || latlngs.length < 3) return;

            // Calcular Área
            var areaMetros = L.GeometryUtil.geodesicArea(latlngs);
            var areaHectareas = (areaMetros / 10000).toFixed(2);

            // Calcular Perímetro
            var perimetro = 0;
            for (var i = 0; i < latlngs.length; i++) {
                var p1 = latlngs[i];
                var p2 = latlngs[(i + 1) % latlngs.length];
                perimetro += p1.distanceTo(p2);
            }

            var centro = layer.getBounds().getCenter();

            // Llenar los inputs
            document.getElementById('latitud').value = centro.lat.toFixed(6);
            document.getElementById('longitud').value = centro.lng.toFixed(6);
            document.getElementById('area_hectareas').value = areaHectareas;
            document.getElementById('perimetro_metros').value = perimetro.toFixed(0);

            // Mostrar el recuadro verde
            document.getElementById('area-value').innerText = areaHectareas;
            document.getElementById('perimetro-value').innerText = perimetro.toFixed(0);
            document.getElementById('area-display').style.display = 'block';

            console.log("Área calculada:", areaHectareas, "ha");
        }

        // Al crear el polígono, calculamos automáticamente
        map.on('pm:create', function(e) {
            calcularTodo(e.layer);
        });

        // EL TRUCO FINAL: Al presionar Guardar, buscamos el polígono y calculamos
        document.getElementById('formParcela').addEventListener('submit', function(e) {

            var poligono = null;

            // Buscamos cualquier polígono en el mapa
            map.eachLayer(function(layer) {
                if (layer instanceof L.Polygon) {
                    poligono = layer;
                }
            });

            if (!poligono) {
                e.preventDefault();
                alert("❌ Por favor, dibuja tu terreno con el pentágono antes de guardar.");
                return;
            }

            // Calculamos los valores
            calcularTodo(poligono);

            // Verificamos que el área no sea 0
            var area = document.getElementById('area_hectareas').value;
            if (area === '0.00' || area === '0' || area === '') {
                e.preventDefault();
                alert("❌ Error: el área es 0. Borra el dibujo y vuelve a intentarlo.");
            }
        });

        // Función del buscador
        function buscarLugar() {
            var query = document.getElementById('buscador').value;
            if (query.trim() === '') return;

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        var lat = parseFloat(data[0].lat);
                        var lon = parseFloat(data[0].lon);
                        var displayName = data[0].display_name;
                        var partes = displayName.split(',');

                        var nombreCiudad = partes[0].trim();
                        var distrito = partes.length > 1 ? partes[1].trim() : nombreCiudad;

                        map.flyTo([lat, lon], 16, { duration: 2 });

                        document.getElementById('nombre_parcela').value = "Parcela " + nombreCiudad;
                        document.getElementById('distrito_parcela').value = distrito;
                    } else {
                        alert("No se encontró el lugar. Intenta con un nombre más general.");
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        document.getElementById('buscador').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') { e.preventDefault(); buscarLugar(); }
        });
    </script>
</body>
</html>
