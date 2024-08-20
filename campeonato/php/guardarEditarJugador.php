<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardar Cambios de Jugador</title>
</head>
<body>
    <h1>Guardar Cambios de Jugador</h1>
    <hr color="orange" size="4">
    <br>

    <?php
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webCampeonato";  // Nombre de la base de datos

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $cod_j = $_POST['cod_j'];
    $ci = $_POST['ci'];
    $nombre = $_POST['nombre'];
    $paterno = $_POST['paterno'];
    $materno = $_POST['materno'];
    $fechaNac = $_POST['fechaNac'];
    $sexo = $_POST['sexo'];
    $codEquipo = $_POST['codEquipo'];

    // Actualizar el jugador en la base de datos
    $query = "UPDATE jugador SET ci='$ci', nombre='$nombre', paterno='$paterno', 
              materno='$materno', fechaNac='$fechaNac', sexo='$sexo', 
              codEquipo='$codEquipo' WHERE cod_j=$cod_j";

    if ($conn->query($query) === TRUE) {
        echo "Jugador actualizado correctamente.";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Redireccionar a la página de inicio
    header("Location: ../index.html");
    exit();
    ?>
</body>
</html>
