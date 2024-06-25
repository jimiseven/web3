<?php

include "conexion_bd.php";

// conecciones
if (!$conn) {
    die("Error connecting to database: " . mysqli_connect_error());
}

$sql = "SELECT nombreFlor, SUM(cantidadCosecha) AS cantidadTotalCosecha FROM bdflores_v1.flor GROUP BY nombreFlor";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantidad Total de Cosecha por Flor</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.html">REGISTRAR FLORES</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="listado.php">FLORES REGISTRADAS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="registrar_tipo.html">REGISTRAR TIPOS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="listar_tipos.php">TIPOS REGISTRADOS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="inventario.php">INVENTARIO GENERAL</a>
        </li>
      </ul>
<div class="container mt-3">
    <h2>COSECHA POR FLOR</h2>

    <?php
    // Check if query was successful
    if ($result) {
        echo "<table class='table table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nombre de la Flor</th>";
        echo "<th>Cantidad Total de Cosecha</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Fetch each flower harvest count row and display data in table cells
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["nombreFlor"] . "</td>";
            echo "<td>" . $row["cantidadTotalCosecha"] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

        // Free result set
        mysqli_free_result($result);
    } else {
        echo "<div class='alert alert-danger'>Error retrieving harvest count data: " . mysqli_error($conn) . "</div>";
    }
    ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php

// Close database connection
mysqli_close($conn);
?>
