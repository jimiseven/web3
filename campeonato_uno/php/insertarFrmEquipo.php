<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crear equipo</title>
</head>
<body>
    <h1>NUEVO EQUIPO</h1>
    <hr color="orange" size="4">
    <br>
    <form action="guardarFrmEquipo.php" method="GET">
        Nombre Equipo : <input type ="text" name="nomEq"><br>
        Fecha de Fundacion : <input type="date" name="fecha"><br>
        Color Equipo : <input type="text" name="color"><br>
        <input type="submit" value="Guardar">
        <input type="reset" value="Cancelar">
    </form>
</body>
</html>