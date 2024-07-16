<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root"; // reemplaza 'root' con tu nombre de usuario de MySQL
$password = ""; // reemplaza con tu contraseña de MySQL
$dbname = "carnesDB";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener tipos de carnes
$sql = "SELECT nombreTipo FROM tipos_de_carnes";
$result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}

if ($result->num_rows > 0) {
    // Mostrar opciones
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . htmlspecialchars($row['nombreTipo']) . "'>" . htmlspecialchars($row['nombreTipo']) . "</option>";
    }
} else {
    echo "<option>No hay tipos disponibles</option>";
}

// Cerrar conexión
$conn->close();
?>
