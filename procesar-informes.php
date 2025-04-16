<?php
// Datos para la conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Incluir la biblioteca PhpSpreadsheet y declarar el namespace al inicio
require 'vendor/autoload.php'; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Manejar solicitudes POST (Formulario HTML o JSON)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Detectar si los datos vienen como JSON
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    if ($contentType === "application/json") {
        $data = json_decode(file_get_contents("php://input"), true);

        $fecha_inicial = $data['fecha-inicial'] ?? null;
        $fecha_final = $data['fecha-final'] ?? null;
        $empresa = $data['empresa'] ?? null;
        $sucursal = $data['sucursal'] ?? null;
        $inmueble = $data['inmueble'] ?? null;
        $cedula = $data['cedula'] ?? null;
        $placa = $data['placa'] ?? null;
        $seleccionar = $data['seleccionar'] ?? null;
        $formato = $data['formato'] ?? null;
    } else {
        $fecha_inicial = $_POST['fecha-inicial'] ?? null;
        $fecha_final = $_POST['fecha-final'] ?? null;
        $empresa = $_POST['empresa'] ?? null;
        $sucursal = $_POST['sucursal'] ?? null;
        $inmueble = $_POST['inmueble'] ?? null;
        $cedula = $_POST['cedula'] ?? null;
        $placa = $_POST['placa'] ?? null;
        $seleccionar = $_POST['seleccionar'] ?? null;
        $formato = $_POST['formato'] ?? null;
    }

    if (empty($fecha_inicial) || empty($fecha_final)) {
        die("Por favor completa las fechas para generar el informe.");
    }

    $sql = "INSERT INTO reportes (fecha_inicial, fecha_final, empresa, sucursal, inmueble, cedula, placa, tipo_reporte, formato)
            VALUES ('$fecha_inicial', '$fecha_final', '$empresa', '$sucursal', '$inmueble', '$cedula', '$placa', '$seleccionar', '$formato')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if ($seleccionar === "excel") {
        generarInformeExcel($conn, $fecha_inicial, $fecha_final, $empresa, $sucursal, $inmueble, $cedula, $placa);
    } elseif ($seleccionar === "pdf") {
        generarInformePDF($conn, $fecha_inicial, $fecha_final, $empresa, $sucursal, $inmueble, $cedula, $placa);
    }

    $conn->close();
}

function generarInformeExcel($conn, $fecha_inicial, $fecha_final, $empresa, $sucursal, $inmueble, $cedula, $placa) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Fecha Inicial');
    $sheet->setCellValue('B1', 'Fecha Final');
    $sheet->setCellValue('C1', 'Empresa');
    $sheet->setCellValue('D1', 'Sucursal');

    $query = "SELECT * FROM reportes WHERE fecha_inicial >= '$fecha_inicial' AND fecha_final <= '$fecha_final'";
    $result = $conn->query($query);

    $rowIndex = 2;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowIndex, $row['fecha_inicial']);
        $sheet->setCellValue('B' . $rowIndex, $row['fecha_final']);
        $sheet->setCellValue('C' . $rowIndex, $row['empresa']);
        $sheet->setCellValue('D' . $rowIndex, $row['sucursal']);
        $rowIndex++;
    }

    $writer = new Xlsx($spreadsheet);
    $writer->save('informe.xlsx');
    echo "Informe Excel generado correctamente.";
}

function generarInformePDF($conn, $fecha_inicial, $fecha_final, $empresa, $sucursal, $inmueble, $cedula, $placa) {
    require('fpdf/fpdf.php');
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Fecha Inicial');
    $pdf->Cell(60, 10, 'Fecha Final');

    $query = "SELECT * FROM reportes WHERE fecha_inicial >= '$fecha_inicial' AND fecha_final <= '$fecha_final'";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $pdf->Ln();
        $pdf->Cell(40, 10, $row['fecha_inicial']);
        $pdf->Cell(60, 10, $row['fecha_final']);
    }

    $pdf->Output('informe.pdf', 'D');
    echo "Informe PDF generado correctamente.";
}
?>
