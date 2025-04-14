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
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $estado_visita = htmlspecialchars($_POST['estado_visita'], ENT_QUOTES, 'UTF-8');
    $arl_checkbox = isset($_POST['arl_checkbox']) ? 1 : 0;
    $observaciones = htmlspecialchars($_POST['observaciones'], ENT_QUOTES, 'UTF-8');
    $id_zona = (int) $_POST['id_zona']; // Convertir a entero para mayor seguridad

    // Consulta con sentencia preparada
    $stmt = $conn->prepare("INSERT INTO visitas (numero_documento, nombres, apellidos, fecha_inicio, fecha_fin, estado_visita, arl_checkbox, observaciones, id_zona)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssisi", $documento, $nombres, $apellidos, $fecha_inicio, $fecha_fin, $estado_visita, $arl_checkbox, $observaciones, $id_zona);

    if ($stmt->execute()) {
        echo "Información guardada con éxito";
    } else {
        echo "Error al guardar la información: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
