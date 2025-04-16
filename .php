<?php
// Ejemplo de API para validar usuarios
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

$conn = new mysqli($servername, $username, $password, $dbname);

// Validación de conexión
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Falló la conexión: " . $conn->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM usuarios WHERE username = ? AND password = ?");
    $query->bind_param("ss", $user, $pass);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Usuario válido"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Usuario no válido"]);
    }
    $query->close();
}

$conn->close();
?>
