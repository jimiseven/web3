<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de flores</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>
    <div class="container">
        <h2>Listado de flores</h2>

        <?php
        // Database connection (replace with your actual path)
        include "conexion_bd.php";

        // Check connection
        if (!$conn) {
            die("Error connecting to database: " . mysqli_connect_error());
        }

        // Retrieve flower data
        $sql = "SELECT * FROM bdflores_v1.flor";
        $result = mysqli_query($conn, $sql);

        // Check if query was successful
        if ($result) {
            echo "<table class='table table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre</th>";
            echo "<th>Tipo</th>";
            echo "<th>Fecha de producción</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            // Fetch each flower row and display data in table cells
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["idFlor"] . "</td>";
                echo "<td>" . $row["nombreFlor"] . "</td>";

                // Get the type name based on the type ID
                $tipoId = $row["idTipo"];
                $tipoSql = "SELECT nombreTipo FROM bdflores_v1.tipo WHERE idTipo = $tipoId";
                $tipoResult = mysqli_query($conn, $tipoSql);
                if ($tipoResult) {
                    $tipoRow = mysqli_fetch_assoc($tipoResult);
                    echo "<td>" . $tipoRow["nombreTipo"] . "</td>";
                    mysqli_free_result($tipoResult);
                } else {
                    echo "<td>Error: Tipo no encontrado</td>";
                }

                echo "<td>" . $row["fechaProduccion"] . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";

            // Free result set
            mysqli_free_result($result);
        } else {
            echo "Error retrieving flower data: " . mysqli_error($conn);
        }

        // Close database connection
        mysqli_close($conn);
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
