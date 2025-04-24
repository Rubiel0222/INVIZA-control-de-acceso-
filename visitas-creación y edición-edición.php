<?php
// Datos para la conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si los datos llegan correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Detectar el tipo de contenido
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? $_SERVER["CONTENT_TYPE"] : '';

    if (strpos($contentType, "application/json") !== false) {
        $inputJSON = file_get_contents("php://input");
        $data = json_decode($inputJSON, true);
    } else {
        $data = $_POST;
    }

    // Extraer valores de la solicitud
    $documento = $data['documento'] ?? null;
    $nombres = $data['nombres'] ?? null;
    $apellidos = $data['apellidos'] ?? null;
    $fecha_ingreso = $data['fecha_ingreso'] ?? null;
    $fecha_fin = $data['fecha_fin'] ?? null;
    $estado_visita = $data['estado_visita'] ?? null;
    $arl_checkbox = $data['arl_checkbox'] ?? 0;
    $ingresos = $data['ingresos'] ?? null;
    $empresa_origen = $data['empresa_origen'] ?? null;
    $placa = $data['placa'] ?? null;
    $id_zona = $data['id_zona'] ?? null;

    // Validación de campos obligatorios
    if (empty($documento) || empty($nombres) || empty($fecha_ingreso)) {
       
    }

    // Preparar consulta para INSERTAR datos
    $stmt = $conn->prepare("INSERT INTO visitas (documento, nombres, apellidos, fecha_ingreso, fecha_fin, estado_visita, arl_checkbox, ingresos, empresa_origen, placa, id_zona) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssssssiisss", $documento, $nombres, $apellidos, $fecha_ingreso, $fecha_fin, $estado_visita, $arl_checkbox, $ingresos, $empresa_origen, $placa, $id_zona);

    if ($stmt->execute()) {
        echo "Registro exitoso.";
    } else {
        echo "Error al insertar: " . $stmt->error;
    }

    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>
