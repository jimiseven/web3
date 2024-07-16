<?php
include("conexion_bd.php");

// Obtener datos de la base de datos
$sql = "SELECT carnes.id, carnes.nombre, carnes.cantidad, carnes.costo, tipos_de_carnes.tipo, carnes.fecha_produccion 
        FROM carnes 
        INNER JOIN tipos_de_carnes ON carnes.id_tipo = tipos_de_carnes.id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Carnes</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.html">CarnesDelicias</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="registrar_carnes.html">REGISTRAR CARNES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listado_carnes.php">CARNES REGISTRADAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registrar_tipo_carnes.html">REGISTRAR TIPOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listar_tipos.php">TIPOS REGISTRADOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listar_ingresos_agrupados.php">INVENTARIO GENERAL</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h2>Listado de Carnes</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Costo</th>
                            <th>Tipo</th>
                            <th>Fecha de Producción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["nombre"] . "</td>";
                                echo "<td>" . $row["cantidad"] . "</td>";
                                echo "<td>" . $row["costo"] . "</td>";
                                echo "<td>" . $row["tipo"] . "</td>";
                                echo "<td>" . $row["fecha_produccion"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No se encontraron registros</td></tr>";
                        }
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
