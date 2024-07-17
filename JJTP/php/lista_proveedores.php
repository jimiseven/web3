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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.html">Gestión de Carnes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="lista_carnes.php">Ver Carnes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lista_proveedores.php">Ver Proveedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../registroCarnes.html">Registrar Carne</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../proveedores_reg.html">Registrar Proveedor</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
