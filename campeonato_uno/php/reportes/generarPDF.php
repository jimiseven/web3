<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar PDF de prueba</title>
</head>
<body>
    
</body>
</html>
<?php
    $html=ob_get_clean();//para obtener el contenido del bufer actual
    require_once "../../libreria/dompdf/autoload.inc.php";
    use Dompdf\Dompdf;
    $dompdf=new Dompdf();// objeto que me permitirá trabajar con 
                //las conversiones de html a pdf
    $dompdf->loadHtml("Ejemplo de PDF");
    $dompdf->setPaper('letter');
    $dompdf->render();
    $dompdf->stream("nomPDF.pdf",array("Attachement"=>false));
    //false para que se visualice el pdf generado
?>