<?php
// Incluir el archivo de conexión
include 'php/conexion.php';

// Verificar si se ha pasado un ID de menú
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los detalles del menú actual
    $sql = "SELECT * FROM menus WHERE id = $id";
    $resultado = $conn->query($sql);
    $menu = $resultado->fetch_assoc();
}

// Verificar si el formulario de modificación fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Verificar si el usuario ha subido una nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        // Directorio donde se guardarán las imágenes
        $target_dir = "imgs/";
        $imagen = $_FILES['imagen'];
        $target_file = $target_dir . basename($imagen['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Comprobar si el archivo es una imagen
        $check = getimagesize($imagen['tmp_name']);
        if ($check !== false && ($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "png" || $imageFileType == "gif")) {
            // Mover la imagen al servidor
            if (move_uploaded_file($imagen['tmp_name'], $target_file)) {
                // Actualizar también la imagen en la base de datos
                $sql = "UPDATE menus SET nombre = '$nombre', descripcion = '$descripcion', url_imagen = '$target_file' WHERE id = $id";
            } else {
                echo "Error al subir la nueva imagen.";
            }
        } else {
            echo "Archivo no válido. Solo se permiten JPG, JPEG, PNG y GIF.";
        }
    } else {
        // Si no se subió una nueva imagen, solo actualizar el nombre y descripción
        $sql = "UPDATE menus SET nombre = '$nombre', descripcion = '$descripcion' WHERE id = $id";
    }

    // Ejecutar la consulta de actualización
    if ($conn->query($sql) === TRUE) {
        // Redirigir al listado de menús con un mensaje de éxito
        header("Location: listado_menus.php?mensaje=Menu modificado con éxito");
    } else {
        echo "Error al modificar el menú: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Menú</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Modificar Menú</h2>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre del Menú:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $menu['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $menu['descripcion']; ?>" required>
            </div>
            <div class="form-group">
                <label>Imagen Actual:</label><br>
                <img src="<?php echo $menu['url_imagen']; ?>" alt="Imagen actual" style="width: 150px; height: 150px; object-fit: cover;"><br><br>
                <label for="imagen">Subir Nueva Imagen (opcional):</label>
                <input type="file" class="form-control" id="imagen" name="imagen">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Modificar Menú</button>
        </form>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>

