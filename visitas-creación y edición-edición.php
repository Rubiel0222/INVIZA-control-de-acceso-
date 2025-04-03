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

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $documento = $_POST["documento"] ?? null;
    $nombres = $_POST["nombres"] ?? null;
    $apellidos = $_POST["apellidos"] ?? null;
    $fecha_inicio = $_POST["fecha-inicio"] ?? null;
    $estado = $_POST["estado"] ?? null;
    $arl_checkbox = isset($_POST["arl-checkbox"]) ? 1 : 0; // 1 si está seleccionado
    $arl = $_POST["arl"] ?? null;
    $ingresos = $_POST["ingresos"] ?? null;
    $empresa_origen = $_POST["empresa-origen"] ?? null;
    $observaciones = $_POST["observaciones"] ?? null;

    // Validar que el campo obligatorio "documento" esté presente
    if (empty($documento)) {
        echo "El número de documento es obligatorio.";
        exit;
    }

    // Insertar los datos en la tabla correspondiente
    $stmt = $conn->prepare("INSERT INTO visitas_edicion 
        (documento, nombres, apellidos, fecha_inicio, estado, arl_checkbox, arl, ingresos, empresa_origen, observaciones) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssssisiss",
        $documento,
        $nombres,
        $apellidos,
        $fecha_inicio,
        $estado,
        $arl_checkbox,
        $arl,
        $ingresos,
        $empresa_origen,
        $observaciones
    );

    if ($stmt->execute()) {
        echo "Información guardada exitosamente.";
    } else {
        echo "Error al guardar la información: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
