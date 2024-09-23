
<?php
// Incluir la conexión desde el archivo conexion.php
include 'php/conexion.php';

// Procesar el formulario si ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $numero_mesa = $_POST['numero_mesa'];
    $capacidad = $_POST['capacidad'];
    $ubicacion = $_POST['ubicacion'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO mesas (numero_mesa, capacidad, ubicacion) VALUES ('$numero_mesa', '$capacidad', '$ubicacion')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Mesa registrada correctamente.";
    } else {
        $mensaje = "Error: " . $sql . "<br>" . $conn->error;
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
        </div>
      </div>
      <!-- Sidebar end -->

      <!-- centro ini-->
      <div class="container mt-5">
      <h2 class="text-center">Registro de Mesas</h2>
        
        <!-- Mostrar mensaje si el formulario fue procesado -->
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-info" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        
        <form action="" method="POST">
            <div class="mb-3">
                <label for="numero_mesa" class="form-label">Número de Mesa</label>
                <input type="number" class="form-control" id="numero_mesa" name="numero_mesa" required>
            </div>
            <div class="mb-3">
                <label for="capacidad" class="form-label">Capacidad</label>
                <input type="number" class="form-control" id="capacidad" name="capacidad" required>
            </div>
            <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación</label>
                <textarea class="form-control" id="ubicacion" name="ubicacion" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Mesa</button>
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



