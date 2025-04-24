<?php
// Datos para la conexión
$servername = "localhost"; // Servidor local
$username = "root"; // Usuario por defecto de XAMPP
$password = ""; // Contraseña por defecto en XAMPP
$dbname = "inviza"; // Cambia este nombre por el de tu base de datos

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


// Verificar conexión
$stmt = $conexion->prepare("UPDATE visitas SET nombres = ? ");
if (!$stmt) {
    die("Error en la consulta: " . $conexion->error);
}
if (!$sql) {
    die("Error al preparar la consulta: " . $conn->error);
}

// Verificar si el formulario fue enviado o si los datos vienen en formato JSON
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Detectar el tipo de contenido
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? $_SERVER["CONTENT_TYPE"] : '';

    if (strpos($contentType, "application/json") !== false) {
        // Procesar datos JSON
        $inputJSON = file_get_contents("php://input");
        $data = json_decode($inputJSON, true);

        $documento = isset($data['documento']) ? $data['documento'] : null;
        $nombres = isset($data['nombres']) ? $data['nombres'] : null;
        $apellidos = isset($data['apellidos']) ? $data['apellidos'] : null;
        $fecha_inicio = isset($data['fecha_inicio']) ? $data['fecha_inicio'] : null;
        $fecha_fin = isset($data['fecha_fin']) ? $data['fecha_fin'] : null;
        $estado_visita = isset($data['estado_visita']) ? $data['estado_visita'] : null;
        $arl_checkbox = isset($data['arl_checkbox']) ? $data['arl_checkbox'] : 0;
        $ingresos = isset($data['ingresos']) ? $data['ingresos'] : null;
        $empresa_origen = isset($data['empresa_origen']) ? $data['empresa_origen'] : null;
        $placa = isset($data['placa']) ? $data['placa'] : null;
        $id_zona = isset($data['id_zona']) ? $data['id_zona'] : null;
    } else {
        // Procesar datos enviados desde el formulario
        $documento = isset($_POST['documento']) ? $_POST['documento'] : null;
        $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : null;
        $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
        $fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : null;
        $fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
        $estado_visita = isset($_POST['estado_visita']) ? $_POST['estado_visita'] : null;
        $arl_checkbox = isset($_POST['arl_checkbox']) ? $_POST['arl_checkbox'] : 0;
        $ingresos = isset($_POST['ingresos']) ? $_POST['ingresos'] : null;
        $empresa_origen = isset($_POST['empresa_origen']) ? $_POST['empresa_origen'] : null;
        $placa = isset($_POST['placa']) ? $_POST['placa'] : null;
        $id_zona = isset($_POST['id_zona']) ? $_POST['id_zona'] : null;
    }

    // Validación de campos obligatorios
    if (empty($documento) || empty($nombres) || empty($fecha_inicio)) {
        die("Los campos 'documento', 'nombres' y 'fecha_inicio' son obligatorios.");
    }

    // Utilizar una sentencia preparada para insertar datos
    $sql = $conn->prepare("INSERT INTO visitas (numero_documento, nombres, apellidos, fecha_inicio, fecha_fin, estado_visita, arl_checkbox, ingresos, empresa_origen, placa, id_zona) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssssiisss", $documento, $nombres, $apellidos, $fecha_inicio, $fecha_fin, $estado_visita, $arl_checkbox, $ingresos, $empresa_origen, $placa, $id_zona);

    if ($sql->execute()) {
        echo "Registro exitoso.";
    } else {
        echo "Error: " . $sql->error;
    }

    $sql->close();
}

// Cerrar la conexión
$conn->close();
?>
