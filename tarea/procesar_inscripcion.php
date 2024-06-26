<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $form_data = $_POST['form_data'];

        $ci = $form_data['ci'];
        $nombre = $form_data['nombre'];
        $apellido_paterno = $form_data['apellido_paterno'];
        $apellido_materno = $form_data['apellido_materno'];
        $edad = $form_data['edad'];
        $celular = $form_data['celular'];
        $domicilio = $form_data['domicilio'];
        $carrera = $form_data['carrera'];
        $email = $form_data['email'];
        $fecha_nacimiento = $form_data['fecha_nacimiento'];
        $genero = $form_data['genero'];

        // Manejo de la fotografía
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $foto = $_FILES['foto']['name'];
            $foto_tmp = $_FILES['foto']['tmp_name'];

            // Verificar si el directorio "uploads" existe, sino crearlo
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $foto_destino = $upload_dir . basename($foto);
            if (move_uploaded_file($foto_tmp, $foto_destino)) {
                echo "La fotografía se ha subido correctamente.<br>";
            } else {
                echo "Error al mover la fotografía al destino.<br>";
                exit;
            }
        } else {
            echo "Error al subir la fotografía.<br>";
            exit;
        }


        // Mostrar los datos recibidos
        echo "<h2>Datos recibidos:</h2>";
        echo "Carnet de Identidad: " . htmlspecialchars($ci) . "<br>";
        echo "Nombre: " . htmlspecialchars($nombre) . "<br>";
        echo "Apellido Paterno: " . htmlspecialchars($apellido_paterno) . "<br>";
        echo "Apellido Materno: " . htmlspecialchars($apellido_materno) . "<br>";
        echo "Edad: " . htmlspecialchars($edad) . "<br>";
        echo "Número de Celular: " . htmlspecialchars($celular) . "<br>";
        echo "Domicilio: " . htmlspecialchars($domicilio) . "<br>";
        echo "Carrera: " . htmlspecialchars($carrera) . "<br>";
        echo "Correo Electrónico: " . htmlspecialchars($email) . "<br>";
        echo "Fecha de Nacimiento: " . htmlspecialchars($fecha_nacimiento) . "<br>";
        echo "Género: " . htmlspecialchars($genero) . "<br>";
        echo "Fotografía: <img src='" . htmlspecialchars($foto_destino) . "' alt='Fotografía' width='150'><br>";
    } else {
        echo "No se ha enviado ningún formulario.";
    }
    ?>

    <HTML>


    <a class="btn btn-primary" href="formulario_inscripcionAlumnos.php" role="button">Link</a>
    </HTML>
</body>

</html>