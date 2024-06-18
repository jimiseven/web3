<?php 
    require_once("conexion.php");

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $resultado = $conexion -> query("select * from pokemon");

        while($row = mysqli_fetch_array($resultado)){
            echo $row["nombre"]."<br/>";
        }
     ?>
</body>
</html>