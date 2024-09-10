<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $cod_j = $_POST['cod_j'];
    $ci = $_POST['ci'];
    $nombre = $_POST['nombre'];
    $paterno = $_POST['paterno'];
    $materno = $_POST['materno'];
    $fechaNac = $_POST['fechaNac'];
    $sexo = $_POST['sexo'];
    $codEquipo = $_POST['codEquipo'];

    // Consulta para insertar un nuevo jugador en la base de datos
    $sql = "INSERT INTO jugador (cod_j, ci, nombre, paterno, materno, fechaNac, sexo, codEquipo) 
            VALUES ('$cod_j', '$ci', '$nombre', '$paterno', '$materno', '$fechaNac', '$sexo', '$codEquipo')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Jugador registrado exitosamente";
    } else {
        $mensaje = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Jugador</title>
    <!-- Enlace a Bootstrap local -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <!-- Nav var -->
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


                            <form action="registrar_jugador.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="cod_j" class="form-label">Código del Jugador:</label>
                                            <input type="text" class="form-control" name="cod_j" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="ci" class="form-label">Carnet de Identidad:</label>
                                            <input type="text" class="form-control" name="ci" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" name="nombre" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="paterno" class="form-label">Apellido Paterno:</label>
                                            <input type="text" class="form-control" name="paterno" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="materno" class="form-label">Apellido Materno:</label>
                                            <input type="text" class="form-control" name="materno" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="fechaNac" class="form-label">Fecha de Nacimiento:</label>
                                            <input type="date" class="form-control" name="fechaNac" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="sexo" class="form-label">Sexo:</label>
                                            <select class="form-select" name="sexo" required>
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="codEquipo" class="form-label">Equipo:</label>
                                            <select class="form-select" name="codEquipo" required>
                                                <?php
                                                // Volver a abrir la conexión a la base de datos para obtener los equipos
                                                include 'conexion.php';

                                                // Consulta para obtener los equipos
                                                $result = $conn->query("SELECT codEquipo, nombreEquipo FROM equipo");

                                                // Llenar el select con los equipos
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<option value='{$row['codEquipo']}'>{$row['nombreEquipo']}</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>No hay equipos disponibles</option>";
                                                }

                                                // Cerrar la conexión
                                                $conn->close();
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Registrar Jugador</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Nav var fin -->


    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>