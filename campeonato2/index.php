<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Consultas para obtener el conteo de equipos, jugadores y posiciones
$consultaEquipos = "SELECT COUNT(*) as totalEquipos FROM equipo";
$resultEquipos = $conn->query($consultaEquipos);
$totalEquipos = $resultEquipos->fetch_assoc()['totalEquipos'];

$consultaJugadores = "SELECT COUNT(*) as totalJugadores FROM jugador";
$resultJugadores = $conn->query($consultaJugadores);
$totalJugadores = $resultJugadores->fetch_assoc()['totalJugadores'];

$consultaPosiciones = "SELECT COUNT(*) as totalPosiciones FROM posiciones";
$resultPosiciones = $conn->query($consultaPosiciones);
$totalPosiciones = $resultPosiciones->fetch_assoc()['totalPosiciones'];

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Equipos y Jugadores</title>
    <link rel="stylesheet" href="css/styles.css"> 
</head>
<body>
    <div class="container">
        <button onclick="redireccionar('php/registrar_equipo.php')">Insertar Equipo</button>
        <button onclick="redireccionar('php/listar_equipos.php')">Listar Equipo</button>
        <button onclick="redireccionar('php/registrar_jugador.php')">Insertar Jugador</button>
        <button onclick="redireccionar('php/listar_jugadores.php')">Listar Jugador</button>
        <button onclick="redireccionar('php/registrar_posicion.php')">Registrar Posiciones</button>
        <button onclick="redireccionar('php/listar_posiciones.php')">Listar Posiciones</button>
        <button onclick="redireccionar('php/registrar_relacion.php')">Registrar Posiciones Jugadores</button>
        <button onclick="redireccionar('php/listar_relaciones.php')">Listar Posiciones Jugadores</button>
    </div>

    <!-- Tabla Resumen -->
    <h2>Resumen de Registros</h2>
    <table class="summary-table">
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Total Registrado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Equipos Registrados</td>
                <td><?php echo $totalEquipos; ?></td>
            </tr>
            <tr>
                <td>Jugadores Registrados</td>
                <td><?php echo $totalJugadores; ?></td>
            </tr>
            <tr>
                <td>Posiciones Registradas</td>
                <td><?php echo $totalPosiciones; ?></td>
            </tr>
        </tbody>
    </table>

    <script src="script.js"></script> 
</body>
</html>
