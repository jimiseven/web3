<?php 
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "test1";

    $conexion =  new mysqli($server, $user, $pass, $db);

    if($conexion -> connect_error) {
        die("conexion fallida". $conexion -> connect_errno);

    }else{
        echo"conectado";
    }


    ?>
