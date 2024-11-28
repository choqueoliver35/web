<?php
// Configurar la conexión a la base de datos
$host = "localhost"; // Servidor
$user = "root";      // Usuario de la base de datos
$pass = "";          // Contraseña
$db = "sensores"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar los datos
$sql = "SELECT zona, temperatura, humedad, metano, humo, malos_olores FROM lecturas";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    // Convertir los resultados a un array
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
