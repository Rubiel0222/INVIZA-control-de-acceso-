<?php
header("Content-Type: application/json");

// Configuración de conexión
$servername = "localhost";
$username = "root";
$password = "";
$database = "inviza";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    echo json_encode(["error" => "❌ Error en la conexión: " . $conn->connect_error]);
    exit;
}

// Función para validar entrada
function validateInput($data) {
    return htmlspecialchars(trim($data));
}

// Procesamiento de solicitudes
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "GET") {
    // 🔍 Obtener lista de funcionarios
    $sql = "SELECT id, documento, nombres, sucursales, zona, estado, fecha_inicio, fecha_fin FROM funcionarios";
    $result = $conn->query($sql);

    if (!$result) {
        echo json_encode(["error" => "❌ Error en la consulta SQL: " . $conn->error]);
        exit;
    }

    $funcionarios = [];
    while ($row = $result->fetch_assoc()) {
        $funcionarios[] = $row;
    }

    echo json_encode($funcionarios);
} elseif ($method == "POST") {
    // ➕ Insertar nuevo funcionario
    $documento = validateInput($_POST["documento"]);
    $nombres = validateInput($_POST["nombres"]);
    $sucursal = validateInput($_POST["sucursal"]);
    $zona = validateInput($_POST["zona"]);
    $estado = validateInput($_POST["estado"]);
    $fecha_inicio = validateInput($_POST["fecha_inicio"]);
    $fecha_fin = validateInput($_POST["fecha_fin"]);

    if (!empty($documento) && !empty($nombres)) {
        $sql = "INSERT INTO funcionarios (documento, nombres, sucursales, zona, estado, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $documento, $nombres, $sucursal, $zona, $estado, $fecha_inicio, $fecha_fin);

        if ($stmt->execute()) {
            echo json_encode(["message" => "✅ Funcionario agregado exitosamente"]);
        } else {
            echo json_encode(["error" => "❌ Error al guardar: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "❌ Faltan campos obligatorios"]);
    }
} elseif ($method == "DELETE") {
    // 🗑 Eliminar funcionario por ID
    parse_str(file_get_contents("php://input"), $data);
    $id = $data["id"] ?? "";

    if (!empty($id)) {
        $sql = "DELETE FROM funcionarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "✅ Funcionario eliminado correctamente"]);
        } else {
            echo json_encode(["error" => "❌ Error al eliminar: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "❌ ID inválido"]);
    }
}

$conn->close();
?>
