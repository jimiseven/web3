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
        $uploadOk = 1;
        // Obtener la extensión del archivo
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si el archivo es una imagen real
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if ($check !== false) {
                echo "El archivo es una imagen - " . $check["mime"] . ".<br>";
                $uploadOk = 1;
            } else {
                echo "El archivo no es una imagen.<br>";
                $uploadOk = 0;
            }
        }

        // Verificar si el archivo ya existe
        if (file_exists($target_file)) {
            echo "Lo siento, el archivo ya existe.<br>";
            $uploadOk = 0;
        }

        // Verificar el tamaño del archivo
        if ($_FILES["file"]["size"] > 500000) { // 500 KB
            echo "Lo siento, el archivo es demasiado grande.<br>";
            $uploadOk = 0;
        }

        // Permitir solo ciertos formatos de archivo
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.<br>";
            $uploadOk = 0;
        }

        // Verificar si $uploadOk es 0 por algún error
        if ($uploadOk == 0) {
            echo "Lo siento, tu archivo no fue subido.<br>";
        } else {
            // Intentar subir el archivo
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "El archivo " . htmlspecialchars(basename($_FILES["file"]["name"])) . " ha sido subido.<br>";
                echo "<img src='$target_file' alt='Imagen subida' style='max-width: 300px;'>";
            } else {
                echo "Lo siento, hubo un error al subir tu archivo.<br>";
            }
        }
    }
    ?>
</body>
</html>
