<?php
// Include database connection file (replace with your actual path)
include "conexion_bd.php";

// Check connection
if (!$conn) {
    die("Error connecting to database: " . mysqli_connect_error());
}

// Handle form submission
if (isset($_POST['nombreTipo']) && isset($_POST['clima']) && isset($_POST['observacion'])) {
    $nombreTipo = mysqli_real_escape_string($conn, $_POST['nombreTipo']);
    $clima = mysqli_real_escape_string($conn, $_POST['clima']);
    $observacion = mysqli_real_escape_string($conn, $_POST['observacion']);

    // Validate input (optional)
    // Add validation logic here to check for invalid data

    // Insert data into "tipo" table
    $sql = "INSERT INTO bdflores_v1.tipo (nombreTipo, clima, observacion) VALUES ('$nombreTipo', '$clima', '$observacion')";
    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success'>Tipo registrado correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al registrar el tipo: " . mysqli_error($conn) . "</div>";
    }
}

// Close database connection
mysqli_close($conn);
?>
