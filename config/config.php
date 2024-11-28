<?php
    $host="localhost";
    $user="root";
    $password="";
    $db="db_basurero";

    $conexion=new mysqli($host,$user,$password,$db);
    if($conexion->connect_errno){
        echo "fallo la conexion a la base de datos".$conexion->connect_errno;
    }  
?>