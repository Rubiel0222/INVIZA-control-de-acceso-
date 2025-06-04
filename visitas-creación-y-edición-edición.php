<?php
// Datos para la conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar y validar datos
    $documento = htmlspecialchars($_POST['documento'], ENT_QUOTES, 'UTF-8');
    $nombres = htmlspecialchars($_POST['nombres'], ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars($_POST['apellidos'], ENT_QUOTES, 'UTF-8');

    // Validar que fecha_ingreso no esté vacía antes de asignarla
    if (isset($_POST['fecha_ingreso']) && !empty($_POST['fecha_ingreso'])) {
        $fecha_ingreso = $_POST['fecha_ingreso'];
    } 
    $fecha_fin = $_POST['fecha_fin'];
    $estado_visita = htmlspecialchars($_POST['estado_visita'], ENT_QUOTES, 'UTF-8');
    $arl_checkbox = isset($_POST['arl_checkbox']) ? 1 : 0;
    $placa = isset($_POST['placa']) ? htmlspecialchars($_POST['placa'], ENT_QUOTES, 'UTF-8') : null;
    $observaciones = htmlspecialchars($_POST['observaciones'], ENT_QUOTES, 'UTF-8');
    $id_zona = isset($_POST['id_zona']) ? (int) $_POST['id_zona'] : null;

    // Verificar conexión
    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Definir la consulta SQL
    $sql = "INSERT INTO visitas (documento, nombres, apellidos, fecha_ingreso, fecha_fin, estado_visita, arl_checkbox, placa, id_zona)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    
    // Verificar si la preparación fue exitosa
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    // Enlazar parámetros y ejecutar
    $stmt->bind_param("ssssssisi", $documento, $nombres, $apellidos, $fecha_ingreso, $fecha_fin, $estado_visita, $arl_checkbox, $placa, $id_zona);
    
    if ($stmt->execute()) {
        echo "Información guardada con éxito.";
    } else {
        echo "Error al guardar la información: " . $stmt->error;
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conn->close();
}
?>
