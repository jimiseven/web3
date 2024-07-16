<?php
include 'connect.php';

$sql = "SELECT c.CarneID, c.Nombre, c.Tipo, c.Precio, p.Nombre as Proveedor FROM Carnes c LEFT JOIN Proveedores p ON c.ProveedorID = p.ProveedorID";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Carnes</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Carnes</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Proveedor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["CarneID"] . "</td>";
                        echo "<td>" . $row["Nombre"] . "</td>";
                        echo "<td>" . $row["Tipo"] . "</td>";
                        echo "<td>" . $row["Precio"] . "</td>";
                        echo "<td>" . $row["Proveedor"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay carnes registradas</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="../registroCarnes.html" class="btn btn-secondary">Registrar Carne</a>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
