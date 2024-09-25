<?php
// Incluir la conexión desde el archivo conexion.php
include 'php/conexion.php';

// Procesar el formulario si ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO clientes (nombre, correo_electronico, telefono) VALUES ('$nombre', '$email', '$telefono')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Cliente registrado correctamente.";
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
          <a href="registroReserva.php" class="list-group-item list-group-item-action"> Registro Reservas</a>
        </div>
      </div>
      <!-- Sidebar end -->

      <!-- centro ini-->
      <div class="container mt-5">
      <h2 class="text-center">Registro de Clientes</h2>
        
        <!-- Mostrar mensaje si el formulario fue procesado -->
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-info" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
       </div>
      <!-- centro end -->
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
