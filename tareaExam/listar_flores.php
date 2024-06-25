<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "floreria_v3";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM flor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>ID</th><th>Nombre</th><th>Cantidad</th><th>Costo</th><th>Proveedor</th><th>Tipo</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["idFlor"]. "</td><td>" . $row["nombreFlor"]. "</td><td>" . $row["cantidadPedido"]. "</td><td>" . $row["costo"]. "</td><td>" . $row["idProveedor"]. "</td><td>" . $row["idTipo"]. "</td></tr>";
    }
    echo "</tbody></table>";
} else {
    echo "0 resultados";
}

$conn->close();
?>
