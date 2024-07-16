<?php
include("conexion_bd.php");

// Obtener datos de la base de datos
$sql = "SELECT * FROM tipos_de_carnes";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Tipos de Carnes</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.html">REGISTRAR CARNES</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="listado.php">CARNES REGISTRADAS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="registrar_tipo_carnes.html">REGISTRAR TIPOS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="listar_tipos.php">TIPOS REGISTRADOS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="inventario.php">INVENTARIO GENERAL</a>
        </li>
    </ul>
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h2>Listado de Tipos de Carnes</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["tipo"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No se encontraron registros</td></tr>";
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
