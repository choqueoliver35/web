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
    <title>Monitoreo de Basureros</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            background-color: #343a40;
            color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .chart-container h6 {
            color: white;
        }

        .table-container {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Monitoreo de Basureros</h1>
        <div class="row g-4">
            <!-- Basurero 1 -->
            <div class="col-md-3">
                <div class="chart-container">
                    <h6>Basurero Zona Unifranz</h6>
                    <canvas id="donut1"></canvas>
                    <label for="rango1" class="form-label">Rango máximo:</label>
                    <p>Distancia: <span id="porcentaje1">0</span> cm</p>
                </div>
            </div>
            <!-- Basurero 2 -->
            <div class="col-md-3">
                <div class="chart-container">
                    <h6>Basurero Zona 2 de Febrero</h6>
                    <canvas id="donut2"></canvas>
                    <label for="rango2" class="form-label">Rango máximo:</label>
                    <p>Distancia: <span id="porcentaje2">0</span> cm</p>
                </div>
            </div>
            <!-- Basurero 3 -->
            <div class="col-md-3">
                <div class="chart-container">
                    <h6>Basurero Zona Villa Dolores</h6>
                    <canvas id="donut3"></canvas>
                    <label for="rango3" class="form-label">Rango máximo:</label>
                    <p>Distancia: <span id="porcentaje3">0</span> cm</p>
                </div>
            </div>
            <!-- Basurero 4 -->
            <div class="col-md-3">
                <div class="chart-container">
                    <h6>Basurero Zona Satélite</h6>
                    <canvas id="donut4"></canvas>
                    <label for="rango4" class="form-label">Rango máximo: 450</label>
                    <p>Distancia: <span id="porcentaje4">0</span> cm</p>
                </div>
            </div>
        </div>

        <!-- Tabla de los datos restantes -->
        <div class="table-container">
            <h3>Datos de Sensores</h3>
            <table class="table">
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

    <div class="col-lg-6">
        <div class="chart-container">
            <h4>User Statistics</h4>
            <input type="date" id="fechaInicio">
            <input type="date" id="fechaFin">
            <button id="btnActualizar">Actualizar</button>
            <canvas id="line-chart"></canvas>
        </div>
    </div>


    <script>
        let distancias = [
            <?= isset($data[0]['distancia']) ? $data[0]['distancia'] : 0 ?>,
            <?= isset($data[1]['distancia']) ? $data[1]['distancia'] : 0 ?>,
            <?= isset($data[2]['distancia']) ? $data[2]['distancia'] : 0 ?>,
            <?= isset($data[3]['distancia']) ? $data[3]['distancia'] : 0 ?>
        ];
        let rangos = [450, 450, 450, 450]; // Rango máximo de 450cm

        // Función para crear gráficos Donut dinámicos
        const crearDonut = (id, index) => {
            return new Chart(document.getElementById(id), {
                type: "doughnut",
                data: {
                    labels: ["Lleno", "Vacío"],
                    datasets: [{
                        data: [distancias[index], rangos[index] - distancias[index]],
                        backgroundColor: ["#FF5252", "#4CAF50"]
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

        // Elementos HTML para rango de fechas
        const fechaInicioInput = document.getElementById("fechaInicio");
        const fechaFinInput = document.getElementById("fechaFin");

        // Crear o actualizar el gráfico dinámicamente
        let lineChart;
        let fechas = []; // Almacenar las fechas
        let nivelesPorZona = {
            "Zona Unifranz": [],
            "Zona 2 de Febrero": [],
            "Zona Villa Dolores": [],
            "Zona Satélite": []
        };

        function actualizarGrafico() {
            const fechaInicio = fechaInicioInput.value;
            const fechaFin = fechaFinInput.value;

            // Validar que ambas fechas estén seleccionadas
            if (!fechaInicio || !fechaFin) {
                alert("Por favor, selecciona un rango de fechas.");
                return;
            }

            // Hacer una solicitud al backend
            fetch(`contaminacion.php?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`)
                .then(response => response.json())
                .then(data => {
                    // Procesar los datos para el gráfico
                    data.forEach(item => {
                        if (!fechas.includes(item.fecha)) {
                            fechas.push(item.fecha);
                        }
                        nivelesPorZona[item.zona].push(item.nivel_contaminacion);
                    });

                    // Actualizar las datasets del gráfico sin borrar los datos anteriores
                    if (lineChart) {
                        lineChart.data.labels = fechas; // Actualizamos las fechas
                        lineChart.data.datasets.forEach((dataset, index) => {
                            dataset.data = nivelesPorZona[dataset.label]; // Actualizamos los datos de cada zona
                        });

                        // Marcamos el último punto con un color diferente para mostrar la actualización
                        lineChart.data.datasets.forEach((dataset, index) => {
                            const lastIndex = dataset.data.length - 1;
                            dataset.backgroundColor = (dataset.backgroundColor || []);
                            dataset.backgroundColor[lastIndex] = 'red'; // Marcamos el último punto en rojo
                        });

                        lineChart.update(); // Actualizamos el gráfico
                    }
                })
                .catch(error => console.error("Error al obtener los datos:", error));
        }

        // Crear el gráfico inicial
        function crearGrafico() {
            const ctx = document.getElementById("line-chart").getContext("2d");
            lineChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: fechas,
                    datasets: [{
                            label: "Zona Unifranz",
                            data: nivelesPorZona["Zona Unifranz"],
                            borderColor: "#FF6384",
                            fill: false,
                            backgroundColor: []
                        },
                        {
                            label: "Zona 2 de Febrero",
                            data: nivelesPorZona["Zona 2 de Febrero"],
                            borderColor: "#36A2EB",
                            fill: false,
                            backgroundColor: []
                        },
                        {
                            label: "Zona Villa Dolores",
                            data: nivelesPorZona["Zona Villa Dolores"],
                            borderColor: "#FFCE56",
                            fill: false,
                            backgroundColor: []
                        },
                        {
                            label: "Zona Satélite",
                            data: nivelesPorZona["Zona Satélite"],
                            borderColor: "#4BC0C0",
                            fill: false,
                            backgroundColor: []
                        }
                    ]
                }
            });
        }

        // Agregar un evento para actualizar el gráfico al cambiar las fechas
        document.getElementById("btnActualizar").addEventListener("click", actualizarGrafico);

        // Inicializar el gráfico cuando la página se carga
        crearGrafico();
    </script>

</body>

</html>