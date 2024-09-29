<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Jugador</title>
</head>
<body>
    <h1>Eliminar Jugador</h1>
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

    $cod_j = $_GET['id'];

    // Eliminar el jugador de la base de datos
    $query = "DELETE FROM jugador WHERE cod_j = $cod_j";

    if ($conn->query($query) === TRUE) {
        echo "Jugador eliminado correctamente.";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Redireccionar a la página de inicio
    header("Location: ../index.html");
    exit();
    ?>
</body>
</html>
