<?php
// Iniciar la sesión
session_start();

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "inviza";

// Crear conexión con MySQL
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Error de conexión: " . $conn->connect_error]));
}

// Indicar que la respuesta será JSON
header("Content-Type: application/json");

// Capturar datos en JSON o POST
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) { // Si no llega JSON, usar $_POST
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
} else {
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';
}

// Preparar la consulta SQL para buscar el usuario
$stmt = $conn->prepare("SELECT password, rol FROM usuarios WHERE nombre_usuario = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($db_password, $rol);
    $stmt->fetch();

    // Verificar si la contraseña ingresada coincide con la almacenada en la base de datos
    if (password_verify($password, $db_password)) {
        // Guardar información en la sesión
        $_SESSION["nombre_usuario"] = $username;
        $_SESSION["rol"] = $rol;

        // Respuesta JSON de éxito
        echo json_encode(["status" => "success", "message" => "Inicio de sesión exitoso"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Contraseña incorrecta"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Usuario no encontrado"]); // Se añadió esta línea que faltaba
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
