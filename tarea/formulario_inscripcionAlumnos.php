<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Inscripción - INSTITUTO NACIONAL DE COMERCIO (INCOS)</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
    }

    h1 {
      text-align: center;
      color: #343a40;
      margin-bottom: 30px;
    }

    .form-label {
      font-weight: bold;
      color: #495057;
    }

    .form-control {
      margin-bottom: 15px;
      border-radius: 5px;
    }

    .btn-primary {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #007bff;
      color: white;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    input[type="file"] {
      margin-bottom: 15px;
    }

    select.form-control {
      height: calc(2.25rem + 2px);
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Formulario de Inscripción - INSTITUTO NACIONAL DE COMERCIO</h1>
    <form action="procesar_inscripcion.php" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="ci" class="form-label">Carnet de Identidad:</label>
        <input type="text" id="ci" name="form_data[ci]" class="form-control" placeholder="Ingrese su C.I." required>
      </div>
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" id="nombre" name="form_data[nombre]" class="form-control" placeholder="Ingrese su nombre" required>
      </div>
      <div class="mb-3">
        <label for="apellido_paterno" class="form-label">Apellido Paterno:</label>
        <input type="text" id="apellido_paterno" name="form_data[apellido_paterno]" class="form-control" placeholder="Ingrese su apellido paterno" required>
      </div>
      <div class="mb-3">
        <label for="apellido_materno" class="form-label">Apellido Materno:</label>
        <input type="text" id="apellido_materno" name="form_data[apellido_materno]" class="form-control" placeholder="Ingrese su apellido materno" required>
      </div>
      <div class="mb-3">
        <label for="edad" class="form-label">Edad:</label>
        <input type="number" id="edad" name="form_data[edad]" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="celular" class="form-label">Número de Celular:</label>
        <input type="text" id="celular" name="form_data[celular]" class="form-control" placeholder="Ingrese su número de celular" required>
      </div>
      <div class="mb-3">
        <label for="domicilio" class="form-label">Domicilio:</label>
        <input type="text" id="domicilio" name="form_data[domicilio]" class="form-control" placeholder="Ingrese su domicilio" required>
      </div>
      <div class="mb-3">
        <label for="foto" class="form-label">Fotografía Actualizada:</label>
        <input type="file" id="foto" name="foto" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="carrera" class="form-label">Carrera:</label>
        <select id="carrera" name="form_data[carrera]" class="form-control" required>
          <option value="">Seleccione una carrera</option>
          <option value="contaduria_publica">Contaduría Pública</option>
          <option value="secretariado_ejecutivo">Secretariado Ejecutivo</option>
          <option value="sistemas_informaticos">Sistemas Informáticos</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico:</label>
        <input type="email" id="email" name="form_data[email]" class="form-control" placeholder="Ingrese su correo electrónico" required>
      </div>
      <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="form_data[fecha_nacimiento]" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="genero" class="form-label">Género:</label>
        <select id="genero" name="form_data[genero]" class="form-control" required>
          <option value="">Seleccione su género</option>
          <option value="masculino">Masculino</option>
          <option value="femenino">Femenino</option>
          <option value="otro">Otro</option>
        </select>
      </div>
      <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
  </div>
</body>
</html>
