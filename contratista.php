<?php
header("Content-Type: application/json");
include 'conexion.php';

$sql = "SELECT id_contratista, nombre_contratista, id_empresa, estado, seguridad_social FROM contratista";
$result = $conn->query($sql);

if (!$result) {
    die(json_encode(["error" => "Error en la consulta SQL: " . $conn->error]));
}

$contratistas = [];

while ($row = $result->fetch_assoc()) {
    $contratista[] = $row;
}

echo json_encode($contratista);
$conn->close();



?>

