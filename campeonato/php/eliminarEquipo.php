<?php
       $conexion=mysqli_connect('localhost','root','','webCampeonato');
       $cod=$_REQUEST['codEquipo'];
       $eliminar="delete from equipo where codEquipo=$cod";
       mysqli_query($conexion,$eliminar)or die("Error ........al eliminar equipo");
       echo "Eliminaste un equipo<br><br>
       <a href='listarEquipo.php'> Volver a Listar Equipo </a>";
?>.