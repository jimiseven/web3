<?php
// Incluir la conexión desde el archivo conexion.php
include 'php/conexion.php';

// Procesar el formulario si ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    
    // Manejo de la imagen subida
    $target_dir = "imgs/"; // Carpeta donde se guardarán las imágenes
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    // Verificar el tamaño del archivo (limitar a 2MB por ejemplo)
    if ($_FILES["imagen"]["size"] > 2000000) {
        echo "Lo siento, tu archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir solo ciertos formatos de imagen (JPG, PNG, JPEG)
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Lo siento, solo se permiten archivos JPG, JPEG y PNG.";
        $uploadOk = 0;
    }

    // Subir la imagen si no hubo errores
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            echo "El archivo ". htmlspecialchars( basename( $_FILES["imagen"]["name"])). " ha sido subido.";

            // Guardar el URL de la imagen en la base de datos
            $url_imagen = $target_file;

            // Preparar la consulta SQL
            $sql = "INSERT INTO menus (nombre, descripcion, url_imagen) VALUES ('$nombre', '$descripcion', '$url_imagen')";

            // Ejecutar la consulta
            if ($conn->query($sql) === TRUE) {
                $mensaje = "Menú registrado correctamente.";
            } else {
                $mensaje = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <div class="d-flex">
      <!-- Sidebar ini -->
      <div class="bg-dark border-rigth p-3" id="sidebar">
        <h3 class="text-light">RESTAURANT EL SUR</h3>
        <hr class="text-white" />
        <div class="list-group list-reset">
          <a href="registroCliente.php" class="list-group-item list-group-item-action">Registro Cliente</a>
          <a href="registroMesas.php" class="list-group-item list-group-item-action"> Registro Mesas</a>
          <a href="registrarPlatos.php" class="list-group-item list-group-item-action"> Registro Platos</a>
          <a href="registroReserva.php" class="list-group-item list-group-item-action"> Registro Reservas</a>
        </div>
      </div>
      <!-- Sidebar end -->

      <!-- centro ini-->
      <div class="container mt-5">
      <h2 class="text-center">Registro de Menús</h2>
        
        <!-- Mostrar mensaje si el formulario fue procesado -->
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-info" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Menú</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Subir Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Menú</button>
        </form>
       </div>
      <!-- centro end -->
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>


