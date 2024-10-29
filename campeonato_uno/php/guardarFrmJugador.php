<?php
    $conexion=mysqli_connect('localhost','root','','campeonato');
    $car=$_GET['cedula'];
    $nom=$_GET['nombre'];
    $pat=$_GET['ape_pat'];
    $mat=$_GET['ape_mat'];
    $fec=$_GET['fecha_nac'];
    $sex=$_GET['sexo'];
    $eq=$_GET['equi'];
    $po=$_GET['posicion'];
    $insJug="insert into jugador(ci,nombre,paterno,materno,fechaNac,sexo,codEquipo) 
    values('$car','$nom','$pat','$mat','$fec','$sex','$eq')";

    //echo "<br>la consulta insetar Jugandor es : $insJug <br>";
    mysqli_query($conexion,$insJug);
    //despues de ejecutar insert, recuperaremos el ultimo cod_j generado en la insercion
    $id_jug_insertado=mysqli_insert_id($conexion);
    foreach($_GET['posicion'] as $posiciones){
        echo "entra al foreach";
            $consulta="insert into rel_ju_po set cod_posi=$posiciones, cod_juga=$id_jug_insertado";
            mysqli_query($conexion,$consulta);
    }
    echo "<br>Insertaste un nuevo Jugador<br><br>
    <a href='listarJugador.php'>Listar Jugador</a> ";
?>