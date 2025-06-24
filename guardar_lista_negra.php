<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conexion = new mysqli("localhost", "root", "", "inviza");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $documento     = $_POST['documento'] ?? null;
    $nombres       = $_POST['nombres'] ?? '';
    $apellidos     = $_POST['apellidos'] ?? '';
    $tipo          = $_POST['tipo'] ?? '';
    $observaciones = $_POST['observaciones'] ?? '';
    $estado        = $_POST['estado'] ?? '';
    $fecha         = date('Y-m-d H:i:s');

    if (!$documento || !$estado) {
        die("Faltan datos obligatorios: documento y estado.");
    }

    $query = "INSERT INTO lista_negra 
        (documento, nombres, apellidos, tipo, motivo, fecha_registro, ESTADO) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($query);
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("sssssss", $documento, $nombres, $apellidos, $tipo, $observaciones, $fecha, $estado);

    if ($stmt->execute()) {
        echo "✅ Visitante registrado correctamente en la lista negra.";
    } else {
        echo "❌ Error al guardar: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
