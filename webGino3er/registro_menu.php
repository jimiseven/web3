<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Variable para almacenar mensajes de éxito o error
$mensaje = "";

// Directorio donde se guardarán las imágenes
$target_dir = "imgs/";

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Verificar si se subió un archivo
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        // Información del archivo
        $imagen = $_FILES['imagen'];
        $target_file = $target_dir . basename($imagen['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Comprobar que el archivo es una imagen
        $check = getimagesize($imagen['tmp_name']);
        if ($check !== false) {
            // Comprobar el tamaño del archivo (5MB máximo)
            if ($imagen['size'] <= 5000000) {
                // Comprobar los formatos permitidos (JPG, PNG, JPEG, GIF)
                if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
                    // Mover el archivo a la carpeta de destino
                    if (move_uploaded_file($imagen['tmp_name'], $target_file)) {
                        // Preparar la consulta SQL para insertar los datos
                        $sql = "INSERT INTO menus (nombre, descripcion, url_imagen) VALUES ('$nombre', '$descripcion', '$target_file')";

                        // Ejecutar la consulta
                        if ($conn->query($sql) === TRUE) {
                            $mensaje = "Nuevo menú registrado con éxito";
                        } else {
                            $mensaje = "Error: " . $sql . "<br>" . $conn->error;
                        }
                    } else {
                        $mensaje = "Error al mover la imagen a la carpeta de destino.";
                    }
                } else {
                    $mensaje = "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
                }
            } else {
                $mensaje = "El archivo es demasiado grande. Máximo 5MB.";
            }
        } else {
            $mensaje = "El archivo no es una imagen válida.";
        }
    } else {
        $mensaje = "Por favor, selecciona una imagen.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Menús</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar ini -->
        <div class="bg-dark border-rigth p-3" id="sidebar">
            <h3 class="text-light">RESTAURANT EL SUR</h3>
            <hr class="text-white" />
            <div class="list-group list-reset">
                <a href="listado_clientes.php" class="list-group-item list-group-item-action">Cliente</a>
                <a href="listado_reservas.php" class="list-group-item list-group-item-action">Reservas</a>
                <a href="listado_mesas.php" class="list-group-item list-group-item-action">Mesas</a>
                <a href="listado_menus.php" class="list-group-item list-group-item-action">Platos</a>
                <a href="listado_detalle_reserva.php" class="list-group-item list-group-item-action">Ordenes</a>
            </div>
        </div>
        <!-- Sidebar end -->
        <!-- centro ini-->
        <div class="container">
            <div class="row align-items-center mt-5">
                <div class="col-md-8">
                    <h2>Registro Menu</h2>
                </div>
                <div class="col-md-4 text-right ml-auto">
                    <a href="listado_menus.php" class="btn btn-primary">Ver Listado de Menu</a>
                </div>
            </div>
            <?php
            // Mostrar mensaje de éxito o error si existe
            if (!empty($mensaje)) {
                echo '<div class="alert alert-info">' . $mensaje . '</div>';
            }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nombre">Nombre del Menú:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre del menú" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingresa una breve descripción" required>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen del Menú:</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Registrar Menú</button>
            </form>
        </div>
        <!-- centro end -->
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>