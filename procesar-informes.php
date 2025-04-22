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

// Incluir la biblioteca PhpSpreadsheet y declarar el namespace
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once __DIR__ . "/fpdf/fpdf.php";


// Manejar solicitudes POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $fecha_inicial = $data['fecha-inicial'] ?? $_POST['fecha-inicial'] ?? null;
    $fecha_final = $data['fecha-final'] ?? $_POST['fecha-final'] ?? null;
    $empresa = $data['empresa'] ?? $_POST['empresa'] ?? null;
    $sucursal = $data['sucursal'] ?? $_POST['sucursal'] ?? null;
    $inmueble = $data['inmueble'] ?? $_POST['inmueble'] ?? null;
    $cedula = $data['cedula'] ?? $_POST['cedula'] ?? null;
    $placa = $data['placa'] ?? $_POST['placa'] ?? null;
    $formato = $data['formato'] ?? $_POST['formato'] ?? null;

    if (empty($fecha_inicial) || empty($fecha_final)) {
        die("Por favor completa las fechas para generar el informe.");
    }

    if ($formato === "excel") {
        generarInformeExcel($conn, $fecha_inicial, $fecha_final, $empresa, $sucursal, $inmueble, $cedula, $placa);
    } elseif ($formato === "pdf") {
        generarInformePDF($conn, $fecha_inicial, $fecha_final, $empresa, $sucursal, $inmueble, $cedula, $placa);
    }

    $conn->close();
}

function generarInformeExcel($conn, $fecha_inicial, $fecha_final, $empresa, $sucursal, $inmueble, $cedula, $placa) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Encabezados del archivo Excel
    $sheet->setCellValue('A1', 'Fecha Inicial');
    $sheet->setCellValue('B1', 'Fecha Final');
    $sheet->setCellValue('C1', 'Empresa');
    $sheet->setCellValue('D1', 'Sucursal');
    $sheet->setCellValue('E1', 'Inmueble');
    $sheet->setCellValue('F1', 'Cédula');
    $sheet->setCellValue('G1', 'Placa');

    // Consultar datos
    $query = "SELECT fecha_inicial, fecha_final, empresa, sucursal, inmueble, cedula, placa FROM informes WHERE fecha_inicial >= ? AND fecha_final <= ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $fecha_inicial, $fecha_final);
    $stmt->execute();
    $result = $stmt->get_result();

    // Llenar datos en Excel
    $rowIndex = 2;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowIndex, $row['fecha_inicial']);
        $sheet->setCellValue('B' . $rowIndex, $row['fecha_final']);
        $sheet->setCellValue('C' . $rowIndex, $row['empresa']);
        $sheet->setCellValue('D' . $rowIndex, $row['sucursal']);
        $sheet->setCellValue('E' . $rowIndex, $row['inmueble']);
        $sheet->setCellValue('F' . $rowIndex, $row['cedula']);
        $sheet->setCellValue('G' . $rowIndex, $row['placa']);
        $rowIndex++;
    }

    // Guardar archivo Excel
    $writer = new Xlsx($spreadsheet);
    $fileName = 'Informe.xlsx';
    $writer->save($fileName);
    echo "Informe Excel generado correctamente.";
}

function generarInformePDF($conn, $fecha_inicial, $fecha_final, $empresa, $sucursal, $inmueble, $cedula, $placa) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(40, 10, 'Fecha Inicial');
    $pdf->Cell(60, 10, 'Fecha Final');

    $query = "SELECT fecha_inicial, fecha_final FROM informes WHERE fecha_inicial >= '$fecha_inicial' AND fecha_final <= '$fecha_final'";
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
