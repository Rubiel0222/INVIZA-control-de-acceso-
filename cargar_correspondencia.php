<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$database = "inviza";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    echo json_encode(["error" => "❌ Error en la conexión: " . $conn->connect_error]);
    exit;
}

$sql = "SELECT descripcion, destinatario, propietario, ubicacion, telefono, codigo_envio, entregado_por, enviar_correo FROM correspondencia";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["error" => "❌ Error en la consulta SQL: " . $conn->error]);
    exit;
}

$correspondencias = [];
while ($row = $result->fetch_assoc()) {
    $correspondencias[] = $row;
}

echo json_encode($correspondencias);
$conn->close();
?>
