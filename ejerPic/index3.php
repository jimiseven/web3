<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina para subir imagen</title>
</head>
<body>
    <h2>Subir Imagen</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Selecciona una imagen:</label>
        <input type="file" name="file" id="file" accept="image/*"><br><br>
        <input type="submit" name="submit" value="Subir Imagen">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $target_dir = "uploads/";
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
