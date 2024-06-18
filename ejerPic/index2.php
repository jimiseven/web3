<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen</title>
</head>
<body>
    <h2>Subir Imagen</h2>
    <!-- Formulario HTML para subir una imagen -->
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Selecciona una imagen:</label>
        <input type="file" name="file" id="file" accept="image/*"><br><br>
        <input type="submit" name="submit" value="Subir Imagen">
    </form>

    <?php
    // Script PHP para manejar la subida de la imagen
    if (isset($_POST['submit'])) {
        // Directorio donde se guardarán las imágenes subidas
        $target_dir = "uploads/";
        // Ruta completa del archivo destino
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        // Intentar subir el archivo
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "El archivo " . htmlspecialchars(basename($_FILES["file"]["name"])) . " ha sido subido correctamente.";
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }
    ?>
</body>
</html>
