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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Campeonato</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Campeonato</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="inde1.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline fw-bold">Jugadores</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="php/registrar_jugador.php" class="nav-link px-0"> <span class="d-none d-sm-inline">- Registro</span></a>
                                </li>
                                <li>
                                    <a href="php/listar_jugadores.php" class="nav-link px-0"> <span class="d-none d-sm-inline">- Listado</span></a>
                                </li>
                            </ul>
                        </li>
                        <!-- Equipos -->
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline fw-bold">Equipos</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="php/registrar_equipo.php" class="nav-link px-0"> <span class="d-none d-sm-inline">- Registro</span></a>
                                </li>
                                <li>
                                    <a href="php/listar_equipos.php" class="nav-link px-0"> <span class="d-none d-sm-inline">- Listado</span></a>
                                </li>
                            </ul>
                        </li>
                        <!-- Posiciones -->
                        <li>
                            <a href="#submenu5" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i>
                                <span class="ms-1 d-none d-sm-inline fw-bold">Posiciones</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu5" data-bs-parent="#menu"> <!-- Clase 'show' removida -->
                                <li class="w-100">
                                    <a href="php/registrar_posicion.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline">- Registro</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="php/listar_posiciones.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline">- Listado</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Posiciones Fin-->
                        <!-- Posicion Jugador -->
                        <li>
                            <a href="#submenu7" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i>
                                <span class="ms-1 d-none d-sm-inline fw-bold">Pos Jugadores</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu7" data-bs-parent="#menu"> <!-- Clase 'show' removida -->
                                <li class="w-100">
                                    <a href="php/registrar_relacion.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline">- Registro</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="php/listar_relaciones.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline">- Listado</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Posicion Jugador Fin-->
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <span class="d-none d-sm-inline mx-1">Admin</span>
                    </div>
                </div>
            </div>
            <!-- Contenido central -->
            <div class="col py-3">
                <h3>Informacion general de registros</h3>
                <p class="lead">
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
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>