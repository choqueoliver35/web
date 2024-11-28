<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sensores"; // Nombre de la base de datos

$conn = new mysqli($servername, $username, $password, $database);

// Verificamos si hay errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Realizamos la consulta a la base de datos
$sql = "SELECT id, distancia, temperatura, humedad, metano, humo, malos_olores FROM lecturas WHERE id IN (1, 2, 3, 4)"; // Considerando 4 sensores
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Guardamos los resultados
    }
} else {
    $data = ["error" => "No se encontraron datos"];
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lugares Turísticos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            padding-top: 70px;
            background-color: #f8f9fa;
        }

        .navbar {
            background-image: url('img/fondo_menu.jpeg');
            background-size: cover;
            background-position: center;
            z-index: 1030;
        }

        .navbar .nav-link {
            color: white;
        }

        .navbar .nav-link:hover {
            color: #ddd;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
        }

        .chart-container {
            background-color: #343a40;
            color: white;
            border-radius: 8px;
            padding: 20px;
        }

        .table-dark th,
        .table-dark td {
            color: white;
        }
    </style>



</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top custom-nav sticky">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="listar_Scada.php" class="nav-link">Monitoreo</a>
                    </li>
                    <li class="nav-item d-flex">
                        <?php
                        session_start();
                        if (isset($_SESSION['user_id'])) {
                            echo "<a href='logout.php' class='nav-link'>Cerrar Sesión</a>";
                        } else {
                            echo "<a href='form-update-usuario.php' class='nav-link'>Login</a>";
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <div class="container mt-5">
        <!-- System Visualization -->

        <div class="row g-4">
            <div class="col-lg-15">
                <div class="chart-container">
                    <h4>System Visualization</h4>
                    <!-- Mapa interactivo -->
                    <div id="map" style="width: 100%; height: 450px;"></div> <!-- Este div será el contenedor del mapa -->
                </div>
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-3">
                <div class="chart-container">
                    <h6>Basurero Zona Unifranz Cede El Alto</h6>
                    <canvas id="donut1"></canvas>
                    <p class="text-center">Coordenadas: -16.508639, -68.166440</p>
                    <label for="rango1" class="form-label">Rango máximo: 60 cm</label>
                    <p>Distancia: <span id="porcentaje1">0</span> cm</p>
                    <button class="btn btn-primary" onclick="centrarMapa(-16.508639, -68.166440)">Ir</button>
                </div>
            </div>

            <div class="col-md-3">
                <div class="chart-container">
                    <h6>Basurero Zona 2 de Febrero</h6>
                    <canvas id="donut2"></canvas>
                    <p class="text-center">Coordenadas: -16.617473, -68.195854</p>
                    <label for="rango2" class="form-label">Rango máximo: 60 cm</label>
                    <p>Distancia: <span id="porcentaje2">0</span> cm</p>
                    <button class="btn btn-primary" onclick="centrarMapa(-16.617473, -68.195854)">Ir</button>
                </div>
            </div>

            <div class="col-md-3">
                <div class="chart-container">
                    <h6>Basurero Zona Villa Dolores</h6>
                    <canvas id="donut3"></canvas>
                    <p class="text-center">Coordenadas: -16.509702, -68.159355</p>
                    <label for="rango3" class="form-label">Rango máximo: 60 cm</label>
                    <p>Distancia: <span id="porcentaje3">0</span> cm</p>
                    <button class="btn btn-primary" onclick="centrarMapa(-16.509702, -68.159355)">Ir</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="chart-container">
                    <h6>Basurero Zona Satelite</h6>
                    <canvas id="donut4"></canvas>
                    <p class="text-center">Coordenadas: -16.524179, -68.150770</p>
                    <label for="rango4" class="form-label">Rango máximo: 60 cm</label>
                    <p>Distancia: <span id="porcentaje4">0</span> cm</p>
                    <button class="btn btn-primary" onclick="centrarMapa(-16.524179, -68.150770)">Ir</button>
                </div>
            </div>
        </div>


        <!-- Table Section -->
        <div class="row g-4 mt-4">
            <div class="col-12">
                <div class="chart-container">
                    <h4>Statistics</h4>
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Basurero</th>
                                <th>Temperatura (°C)</th>
                                <th>Humedad (%)</th>
                                <th>Metano</th>
                                <th>Humo</th>
                                <th>Malos Olores</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="tabla1">
                                <td>Zona Unifranz</td>
                                <td><span id="temp1"><?= isset($data[0]['temperatura']) ? $data[0]['temperatura'] : '-' ?></span></td>
                                <td><span id="hum1"><?= isset($data[0]['humedad']) ? $data[0]['humedad'] : '-' ?></span></td>
                                <td><span id="met1"><?= isset($data[0]['metano']) ? $data[0]['metano'] : '-' ?></span></td>
                                <td><span id="humo1"><?= isset($data[0]['humo']) ? $data[0]['humo'] : '-' ?></span></td>
                                <td><span id="malos1"><?= isset($data[0]['malos_olores']) ? $data[0]['malos_olores'] : '-' ?></span></td>
                            </tr>
                            <tr id="tabla2">
                                <td>Zona 2 de Febrero</td>
                                <td><span id="temp2"><?= isset($data[1]['temperatura']) ? $data[1]['temperatura'] : '-' ?></span></td>
                                <td><span id="hum2"><?= isset($data[1]['humedad']) ? $data[1]['humedad'] : '-' ?></span></td>
                                <td><span id="met2"><?= isset($data[1]['metano']) ? $data[1]['metano'] : '-' ?></span></td>
                                <td><span id="humo2"><?= isset($data[1]['humo']) ? $data[1]['humo'] : '-' ?></span></td>
                                <td><span id="malos2"><?= isset($data[1]['malos_olores']) ? $data[1]['malos_olores'] : '-' ?></span></td>
                            </tr>
                            <tr id="tabla3">
                                <td>Zona Villa Dolores</td>
                                <td><span id="temp3"><?= isset($data[2]['temperatura']) ? $data[2]['temperatura'] : '-' ?></span></td>
                                <td><span id="hum3"><?= isset($data[2]['humedad']) ? $data[2]['humedad'] : '-' ?></span></td>
                                <td><span id="met3"><?= isset($data[2]['metano']) ? $data[2]['metano'] : '-' ?></span></td>
                                <td><span id="humo3"><?= isset($data[2]['humo']) ? $data[2]['humo'] : '-' ?></span></td>
                                <td><span id="malos3"><?= isset($data[2]['malos_olores']) ? $data[2]['malos_olores'] : '-' ?></span></td>
                            </tr>
                            <tr id="tabla4">
                                <td>Zona Satélite</td>
                                <td><span id="temp4"><?= isset($data[3]['temperatura']) ? $data[3]['temperatura'] : '-' ?></span></td>
                                <td><span id="hum4"><?= isset($data[3]['humedad']) ? $data[3]['humedad'] : '-' ?></span></td>
                                <td><span id="met4"><?= isset($data[3]['metano']) ? $data[3]['metano'] : '-' ?></span></td>
                                <td><span id="humo4"><?= isset($data[3]['humo']) ? $data[3]['humo'] : '-' ?></span></td>
                                <td><span id="malos4"><?= isset($data[3]['malos_olores']) ? $data[3]['malos_olores'] : '-' ?></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Bottom Charts -->
        <div class="row g-4 mt-4">
            <div class="col-lg-6">
                <div class="chart-container">
                    <h4>Nivel de Riesgo de Procreacion de Bacterias</h4>
                    <canvas id="bar-chart"></canvas>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="chart-container">
                    <h4>User Statistics</h4>
                    <canvas id="line-chart"></canvas>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        let distancias = [
            <?= isset($data[0]['distancia']) ? $data[0]['distancia'] : 0 ?>,
            <?= isset($data[1]['distancia']) ? $data[1]['distancia'] : 0 ?>,
            <?= isset($data[2]['distancia']) ? $data[2]['distancia'] : 0 ?>,
            <?= isset($data[3]['distancia']) ? $data[3]['distancia'] : 0 ?>
        ];
        let rangos = [60, 60, 60, 60]; // Rango máximo de 450cm

        // Función para crear gráficos Donut dinámicos
        const crearDonut = (id, index) => {
            return new Chart(document.getElementById(id), {
                type: "doughnut",
                data: {
                    labels: ["Vacio", "lleno"],
                    datasets: [{
                        data: [distancias[index], rangos[index] - distancias[index]],
                        backgroundColor: ["#4CAF50", "#FF5252"]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });
        };

        // Crear los gráficos iniciales
        const graficos = [
            crearDonut("donut1", 0),
            crearDonut("donut2", 1),
            crearDonut("donut3", 2),
            crearDonut("donut4", 3)
        ];

        // Line Chart
        new Chart(document.getElementById("line-chart"), {
            type: "line",
            data: {
                labels: ["2007", "2008", "2009", "2010", "2011", "2012"],
                datasets: [{
                    label: "Growth Rate",
                    data: [2, 5, 3, 6, 8, 7],
                    borderColor: "#42A5F5",
                    fill: false
                }]
            }
        });


        function extraerDatosDeTabla() {
            const filas = document.querySelectorAll("tbody tr"); // Todas las filas de la tabla
            const datos = [];

            filas.forEach(fila => {
                const columnas = fila.querySelectorAll("td span"); // Seleccionar celdas con spans
                const zona = fila.querySelector("td").textContent.trim(); // Primer celda (nombre de la zona)
                const temperatura = parseFloat(columnas[0]?.textContent.trim()) || 0;
                const humedad = parseFloat(columnas[1]?.textContent.trim()) || 0;
                const metano = parseFloat(columnas[2]?.textContent.trim()) || 0;
                const humo = parseFloat(columnas[3]?.textContent.trim()) || 0;
                const malosOlores = parseFloat(columnas[4]?.textContent.trim()) || 0;

                // Agregar un objeto con los valores de esta fila
                datos.push({
                    zona,
                    temperatura,
                    humedad,
                    metano,
                    humo,
                    malosOlores
                });
            });

            return datos;
        }

        // Función para calcular el nivel de riesgo
        function calcularNivelDeRiesgo({
            temperatura,
            humedad,
            metano,
            humo,
            malosOlores
        }) {
            let riesgo = 0;

            // Criterios para determinar el riesgo
            if (temperatura > 30 || humedad > 80) riesgo++; // Riesgo por temperatura/humedad


            // Categorizar el nivel de riesgo
            if (riesgo === 0) return {
                nivel: "Normal",
                valor: 1,
                color: "#4CAF50"
            }; // Verde
            if (riesgo === 1) return {
                nivel: "Moderado",
                valor: 2,
                color: "#FFC107"
            }; // Amarillo
            return {
                nivel: "Crítico",
                valor: 3,
                color: "#E91E63"
            }; // Rojo
        }

        // Crear el gráfico con ajustes para eje Y
        function crearGrafica() {
            const datos = extraerDatosDeTabla(); // Extraer los datos de la tabla

            const labels = datos.map(dato => dato.zona); // Nombres de las zonas
            const riesgos = datos.map(dato => calcularNivelDeRiesgo(dato));
            const valores = riesgos.map(riesgo => riesgo.valor); // Valores de riesgo (1, 2, 3)
            const colores = riesgos.map(riesgo => riesgo.color); // Colores asociados al nivel de riesgo

            // Crear el gráfico
            new Chart(document.getElementById("bar-chart"), {
                type: "bar",
                data: {
                    labels: labels, // Etiquetas
                    datasets: [{
                        label: "Nivel de Riesgo",
                        data: valores, // Valores numéricos
                        backgroundColor: colores // Colores de las barras
                    }]
                },
                options: {
                    scales: {
                        y: {
                            ticks: {
                                callback: function(value) {
                                    if (value === 1) return "Normal";
                                    if (value === 2) return "Moderado";
                                    if (value === 3) return "Crítico";
                                    return ""; // No mostrar etiquetas adicionales
                                }
                            },
                            beginAtZero: true, // Iniciar desde 0
                            stepSize: 1, // Solo 1 unidad entre cada nivel
                            max: 3 // Máximo nivel es "Crítico"
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }


        // Llamar a la función al cargar el DOM
        document.addEventListener("DOMContentLoaded", () => {
            crearGrafica(); // Crear la gráfica después de cargar los datos
        });


        // Función para actualizar la tabla
        function actualizarTabla() {
            // Hacer una solicitud al backend usando fetch
            fetch("data.php")
                .then(response => response.json()) // Convertir la respuesta en JSON
                .then(data => {
                    // Seleccionar el cuerpo de la tabla
                    const tbody = document.querySelector("table.table tbody");
                    tbody.innerHTML = ""; // Limpiar contenido existente

                    // Recorrer los datos y generar filas dinámicamente
                    data.forEach(item => {
                        const fila = `
                    <tr>
                        <td>${item.zona}</td>
                        <td>${item.temperatura} °C</td>
                        <td>${item.humedad} %</td>
                        <td>${item.metano}</td>
                        <td>${item.humo}</td>
                        <td>${item.malos_olores}</td>
                    </tr>
                `;
                        tbody.innerHTML += fila; // Agregar cada fila al cuerpo de la tabla
                    });
                })
                .catch(error => console.error("Error al actualizar la tabla:", error));
        }

        // Actualizar la tabla cada 5 segundos
        setInterval(actualizarTabla, 5000); // 5000 ms = 5 segundos

        // Llamar a la función al cargar la página
        document.addEventListener("DOMContentLoaded", actualizarTabla);
    </script>



    <!-- Cargar la API de Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap" async defer></script>

    <script>
        // Variable global para almacenar el mapa
        let map;

        function iniciarMap() {
            // Coordenadas de los cuatro basureros
            const ubicaciones = [{
                    lat: -16.508639,
                    lng: -68.166440,
                    titulo: "Basurero Unifranz Cede El Alto"
                },
                {
                    lat: -16.617473,
                    lng: -68.195854,
                    titulo: "Basurero Zona 2 de Febrero"
                },
                {
                    lat: -16.509702,
                    lng: -68.159355,
                    titulo: "Basurero Zona Villa Dolores"
                },
                {
                    lat: -16.524179,
                    lng: -68.150770,
                    titulo: "Basurero Zona Satelite"
                }
            ];

            // Crear el mapa centrado en el primer basurero
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: {
                    lat: -16.5124,
                    lng: -68.1599
                } // Coordenadas de un punto intermedio
            });

            // Crear los marcadores
            ubicaciones.forEach(function(ubicacion) {
                new google.maps.Marker({
                    position: {
                        lat: ubicacion.lat,
                        lng: ubicacion.lng
                    },
                    map: map,
                    title: ubicacion.titulo // Título del marcador que aparecerá al pasar el ratón
                });
            });
        }

        // Función para centrar el mapa en la ubicación deseada
        function centrarMapa(lat, lng) {
            const centro = {
                lat: lat,
                lng: lng
            };
            map.panTo(centro); // Centrar el mapa en las coordenadas proporcionadas
            map.setZoom(16); // Ajustar el nivel de zoom para ver el marcador claramente
        }
    </script>


    <script src="assets/js/bootstrap.bundle.min.js"></script>


</body>

</html>