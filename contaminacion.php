<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$db = "sensores";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el rango de fechas del frontend
$fechaInicio = isset($_GET['fechaInicio']) ? $_GET['fechaInicio'] : null;
$fechaFin = isset($_GET['fechaFin']) ? $_GET['fechaFin'] : null;

// Validar que existan las fechas
if ($fechaInicio && $fechaFin) {
    $sql = "SELECT zona, DATE(fecha) AS fecha, AVG(metano) AS nivel_contaminacion
            FROM sensores
            WHERE DATE(fecha) BETWEEN ? AND ?
            GROUP BY zona, DATE(fecha)
            ORDER BY fecha ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $fechaInicio, $fechaFin);
} else {
    die("Por favor, proporciona un rango de fechas válido.");
}

// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);

// Cerrar conexión
$conn->close();
?>
