<?php
        $conexion=mysqli_connect('localhost','root','','campeonato');
        $cod=$_REQUEST['codEquipo'];
        $eliminar="delete from equipo where codEquipo=$cod";
        mysqli_query($conexion,$eliminar) or die("Error.... al eliminar Equipo");
        echo "Eliminaste un Equipo<br><br>
        <a href='listarEquipo.php'>Volver a Listar Equipos</a>";

?>