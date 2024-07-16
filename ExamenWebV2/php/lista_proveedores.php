<?php
include 'connect.php';

$sql = "SELECT * FROM Proveedores";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proveedores</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Proveedores</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ProveedorID"] . "</td>";
                        echo "<td>" . $row["Nombre"] . "</td>";
                        echo "<td>" . $row["Telefono"] . "</td>";
                        echo "<td>" . $row["Direccion"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay proveedores registrados</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="../proveedores_reg.html" class="btn btn-secondary">Registrar Proveedor</a>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
