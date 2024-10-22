<?php
// Incluir la librería PhpSpreadsheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webcampeonato";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Establecer el encabezado de las columnas
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Cédula de Identidad');
$sheet->setCellValue('C1', 'Nombre');
$sheet->setCellValue('D1', 'Apellido Paterno');
$sheet->setCellValue('E1', 'Apellido Materno');
$sheet->setCellValue('F1', 'Fecha de Nacimiento');
$sheet->setCellValue('G1', 'Sexo');
$sheet->setCellValue('H1', 'Equipo');

// Consulta para obtener los jugadores
$query = "SELECT j.cod_j, j.ci, j.nombre, j.paterno, j.materno, j.fechaNac, j.sexo, e.nombreEquipo 
          FROM jugador j 
          INNER JOIN equipo e ON j.codEquipo = e.codEquipo";
$result = $conn->query($query);

// Escribir los datos en las filas de la hoja de cálculo
$rowNumber = 2; // La fila donde empezarán los datos
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowNumber, $row['cod_j']);
    $sheet->setCellValue('B' . $rowNumber, $row['ci']);
    $sheet->setCellValue('C' . $rowNumber, $row['nombre']);
    $sheet->setCellValue('D' . $rowNumber, $row['paterno']);
    $sheet->setCellValue('E' . $rowNumber, $row['materno']);
    $sheet->setCellValue('F' . $rowNumber, $row['fechaNac']);
    $sheet->setCellValue('G' . $rowNumber, $row['sexo']);
    $sheet->setCellValue('H' . $rowNumber, $row['nombreEquipo']);
    $rowNumber++;
}

// Establecer los encabezados para la descarga del archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="jugadores.xls"');
header('Cache-Control: max-age=0');

// Escribir el archivo en formato .xls
$writer = new Xls($spreadsheet);
$writer->save('php://output');

// Cerrar la conexión
$conn->close();
