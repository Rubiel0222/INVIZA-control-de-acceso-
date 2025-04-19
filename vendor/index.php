<?php
// Incluir el autoload de Composer
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Función para generar un archivo Excel
function generarExcel() {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', '¡Hola, mundo!');
    $sheet->setCellValue('B1', 'Inviza');
    $sheet->setCellValue('C1', 'Proyecto Generador');

    $writer = new Xlsx($spreadsheet);
    $writer->save('test.xlsx');

    echo "¡Archivo Excel creado exitosamente!";
}
?>
