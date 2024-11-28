<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sensores";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['distancia'], $data['temperatura'], $data['humedad'], $data['lluvia'], $data['metano'], $data['humo'], $data['malos_olores'])) {
        $distancia = $data['distancia'];
        $temperatura = $data['temperatura'];
        $humedad = $data['humedad'];
        $lluvia = $data['lluvia'];
        $metano = $data['metano'];
        $humo = $data['humo'];
        $malos_olores = $data['malos_olores'];

        $sql = "UPDATE lecturas SET 
                distancia = ?, 
                temperatura = ?, 
                humedad = ?, 
                lluvia = ?, 
                metano = ?, 
                humo = ?, 
                malos_olores = ?, 
                fecha_hora = NOW()
                WHERE id = 1";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ddiidii", $distancia, $temperatura, $humedad, $lluvia, $metano, $humo, $malos_olores);

        if ($stmt->execute()) {
            echo "Datos actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Datos incompletos recibidos.";
    }
} else {
    echo "Método no permitido. Usa POST.";
}

$conn->close();
?>