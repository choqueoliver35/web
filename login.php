<?php
session_start(); 
require_once('config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $stmt = $conexion->prepare("SELECT id, rol_id FROM usuario WHERE email = ? AND clave = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $rol); 
        $stmt->fetch();
        
        $_SESSION['user_id'] = $userId; 
        $_SESSION['rol'] = $rol; 

        if ($rol == 1) {
            header("Location: listar_Scada.php"); 
        } elseif ($rol == 2) {
            header("Location: menu_recolector.php"); 
        } else {
            echo "Rol no reconocido.";
        }
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }

    $stmt->close();
}
$conexion->close();
?>
