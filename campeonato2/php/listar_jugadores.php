<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Consulta para obtener todos los jugadores registrados
$sql = "SELECT cod_j, ci, nombre, paterno, materno, fechaNac, sexo, codEquipo FROM jugador";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Jugadores</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<!-- Navbar -->

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
                            <a href="../inde1.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline fw-bold">Jugadores</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="registrar_jugador.php" class="nav-link px-0"> <span class="d-none d-sm-inline">- Registro</span></a>
                                </li>
                                <li>
                                    <a href="listar_jugadores.php" class="nav-link px-0"> <span class="d-none d-sm-inline">- Listado</span></a>
                                </li>
                            </ul>
                        </li>
                        <!-- Equipos -->
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline fw-bold">Equipos</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="registrar_equipo.php" class="nav-link px-0"> <span class="d-none d-sm-inline">- Registro</span></a>
                                </li>
                                <li>
                                    <a href="listar_equipos.php" class="nav-link px-0"> <span class="d-none d-sm-inline">- Listado</span></a>
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
                                    <a href="registrar_posicion.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline">- Registro</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="listar_posiciones.php" class="nav-link px-0">
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
                                    <a href="registrar_relacion.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline">- Registro</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="listar_relaciones.php" class="nav-link px-0">
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
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <h2 class="text-center mb-4">Registrar Jugador</h2>

                            <!-- Mostrar mensaje de éxito o error -->
                            <?php if (!empty($mensaje)): ?>
                                <div class="alert alert-info"><?php echo $mensaje; ?></div>
                            <?php endif; ?>
                            <!-- Cambio central -->
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Código del Jugador</th>
                                        <th>Carnet de Identidad</th>
                                        <th>Nombre</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Sexo</th>
                                        <th>Código del Equipo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Comprobar si se encontraron resultados
                                    if ($result->num_rows > 0) {
                                        // Mostrar los datos de cada jugador
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["cod_j"] . "</td>";
                                            echo "<td>" . $row["ci"] . "</td>";
                                            echo "<td>" . $row["nombre"] . "</td>";
                                            echo "<td>" . $row["paterno"] . "</td>";
                                            echo "<td>" . $row["materno"] . "</td>";
                                            echo "<td>" . $row["fechaNac"] . "</td>";
                                            echo "<td>" . $row["sexo"] . "</td>";
                                            echo "<td>" . $row["codEquipo"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>No hay jugadores registrados</td></tr>";
                                    }

                                    // Cerrar la conexión
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>

                            <!-- Cambio central -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar Fin-->


</body>
<!-- Bootstrap JS -->
<script src="../js/bootstrap.bundle.min.js"></script>

</html>