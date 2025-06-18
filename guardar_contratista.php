<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$database = "inviza";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "❌ Error en la conexión: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_contratista = $_POST['id_contratista'];
    $nombre_contratista = $_POST['nombre_contratista'];
    $id_empresa = $_POST['id_empresa'];
    $estado = $_POST['estado'];
    $seguridad_social = $_POST['seguridad_social'];

    // Preparar consulta y manejar errores
    $sql = "INSERT INTO contratista (id_contratista, nombre_contratista, id_empresa, estado, seguridad_social) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die(json_encode(["error" => "❌ Error en la consulta: " . $conn->error]));
    }

    $stmt->bind_param("sssss", $id_contratista, $nombre_contratista, $id_empresa, $estado, $seguridad_social);

    if ($stmt->execute()) {
        echo json_encode(["success" => "✅ Registro guardado con éxito"]);
    } else {
        echo json_encode(["error" => "❌ Error al guardar: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
