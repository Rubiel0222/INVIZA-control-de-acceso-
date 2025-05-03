<?php
// Configuración de la conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión: " . $conn->connect_error]));
}

// Validar y obtener datos del formulario
if (!isset($_POST['documento']) || empty($_POST['documento'])) {
    die(json_encode(["error" => "El campo 'documento' es obligatorio."]));
}

$documento = mysqli_real_escape_string($conn, $_POST['documento']);

// Lógica para verificar la visita y registrar ingreso con consultas preparadas
$query = "SELECT * FROM visitas WHERE documento = ? AND fecha_ingreso <= NOW() AND fecha_fin >= NOW() AND estado_visita = 'activa'";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die(json_encode(["error" => "Error en la preparación de la consulta: " . $conn->error]));
}

$stmt->bind_param("s", $documento);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $zona_id = $row['id_zona'];

    $insert_query = "INSERT INTO visitantes (documento, hora_ingreso, id_zona) VALUES (?, NOW(), ?)";
    $stmt_insert = $conn->prepare($insert_query);

    if (!$stmt_insert) {
        die(json_encode(["error" => "Error en la preparación de la inserción: " . $conn->error]));
    }

    $stmt_insert->bind_param("si", $documento, $zona_id);

    if ($stmt_insert->execute()) {
        echo json_encode(["message" => "Ingreso registrado correctamente."]);
    } else {
        echo json_encode(["error" => "Error al registrar ingreso: " . $conn->error]);
    }
    $stmt_insert->close();
} else {
    echo json_encode(["error" => "Visita no válida o fuera de rango."]);
}

// Cerrar conexiones
if ($stmt) {
    $stmt->close();
}
$conn->close();
?>
