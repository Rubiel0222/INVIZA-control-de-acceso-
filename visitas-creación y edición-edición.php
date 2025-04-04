<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar los datos del formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capturar los datos del formulario
    $documento = $_POST["documento"] ?? null;
    $nombres = $_POST["nombres"] ?? null;
    $apellidos = $_POST["apellidos"] ?? null;
    $fecha_inicio = $_POST["fecha_inicio"] ?? null;
    $fecha_fin = $_POST["fecha_fin"] ?? null;
    $estado_visita = $_POST["estado_visita"] ?? null;
    $arl_checkbox = isset($_POST["arl_checkbox"]) ? 1 : 0;
    $ingresos = $_POST["ingresos"] ?? null;
    $empresa_origen = $_POST["empresa_origen"] ?? null;
    $observaciones = $_POST["observaciones"] ?? null;
    $id_zona = $_POST["id_zona"] ?? null;

    // Validación básica de datos requeridos
    if (empty($documento) || empty($nombres) || empty($apellidos) || empty($fecha_inicio)) {
        echo "Los campos obligatorios no pueden estar vacíos.";
        exit;
    }

    // Insertar los datos en la tabla 'visitas'
    $stmt = $conn->prepare("INSERT INTO visitas (documento, nombres, apellidos, fecha_inicio, fecha_fin, estado_visita, arl_checkbox, ingresos, empresa_origen, observaciones, id_zona) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssisisss", $documento, $nombres, $apellidos, $fecha_inicio, $fecha_fin, $estado_visita, $arl_checkbox, $ingresos, $empresa_origen, $observaciones, $id_zona);

    if ($stmt->execute()) {
        echo "Información guardada exitosamente.";
    } else {
        echo "Error al guardar la información: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
