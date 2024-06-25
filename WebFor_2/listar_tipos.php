<?php
// Include database connection file (replace with your actual path)
include "conexion_bd.php";

// Check connection
if (!$conn) {
    die("Error connecting to database: " . mysqli_connect_error());
}

// Retrieve type data
$sql = "SELECT * FROM bdflores_v1.tipo";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Tipos de Flores</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <h2>Listado de Tipos de Flores</h2>

        <?php
        // Check if query was successful
        if ($result) {
            echo "<table class='table table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre del Tipo</th>";
            echo "<th>Clima</th>";
            echo "<th>Observación</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            // Fetch each type row and display data in table cells
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["idTipo"] . "</td>";
                echo "<td>" . $row["nombreTipo"] . "</td>";
                echo "<td>" . $row["clima"] . "</td>";
                echo "<td>" . $row["observacion"] . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";

            // Free result set
            mysqli_free_result($result);
        } else {
            echo "<div class='alert alert-danger'>Error retrieving type data: " . mysqli_error($conn) . "</div>";
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
