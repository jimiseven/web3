<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Inicializar la variable para el mensaje
$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar si los campos están llenos
    if (!empty($_POST['jugador_id']) && !empty($_POST['posicion_id'])) {
        // Recibir los datos del formulario
        $jugador_id = $_POST['jugador_id'];
        $posicion_id = $_POST['posicion_id'];

        // Consulta para insertar la relación entre jugador y posición
        $sql = "INSERT INTO rel_pos_ju (jugador_id, posicion_id) 
                VALUES (?, ?)";

        // Preparar la consulta para evitar inyecciones SQL
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Vincular los parámetros con los valores recibidos
            $stmt->bind_param("ii", $jugador_id, $posicion_id);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Redirigir al usuario después de registrar la relación
                header("Location: registrar_relacion.php?success=1");
                exit();
            } else {
                $mensaje = "Error al registrar la relación: " . $stmt->error;
            }

            // Cerrar la consulta preparada
            $stmt->close();
        } else {
            $mensaje = "Error en la consulta SQL: " . $conn->error;
        }
    } else {
        $mensaje = "Por favor, selecciona un jugador y una posición.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Relación Jugador-Posición</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
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
                            <h2 class="text-center mb-4">Registrar Relación Jugador-Posición</h2>

                            <!-- Mostrar mensaje de éxito o error -->
                            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                                <div class="alert alert-primary" role="alert">
                                    Posición de Jugador Registrada Exitosamente
                                </div>
                            <?php elseif (!empty($mensaje)): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $mensaje; ?>
                                </div>
                            <?php endif; ?>

                            <form action="registrar_relacion.php" method="post">
                                <div class="mb-3">
                                    <label for="jugador_id" class="form-label">Seleccionar Jugador:</label>
                                    <select name="jugador_id" class="form-select" required>
                                        <?php
                                        // Consulta para obtener los jugadores
                                        $result_jugadores = $conn->query("SELECT id, nombre, paterno FROM jugador");

                                        if ($result_jugadores->num_rows > 0) {
                                            while ($row = $result_jugadores->fetch_assoc()) {
                                                echo "<option value='{$row['id']}'>{$row['nombre']} {$row['paterno']}</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No hay jugadores registrados</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="posicion_id" class="form-label">Seleccionar Posición:</label>
                                    <select name="posicion_id" class="form-select" required>
                                        <?php
                                        // Consulta para obtener las posiciones
                                        $result_posiciones = $conn->query("SELECT id, nombrePosicion FROM posiciones");

                                        if ($result_posiciones->num_rows > 0) {
                                            while ($row = $result_posiciones->fetch_assoc()) {
                                                echo "<option value='{$row['id']}'>{$row['nombrePosicion']}</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No hay posiciones registradas</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Registrar Relación</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cambio central -->
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- Navbar Fin-->
</body>
<script src="../js/bootstrap.bundle.min.js"></script>

</html>