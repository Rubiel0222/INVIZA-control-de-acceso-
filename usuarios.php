<?php
// Datos para la conexión
<<<<<<< HEAD
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";
=======
$servername = "localhost"; // Servidor local
$username = "root"; // Usuario por defecto de XAMPP
$password = ""; // Contraseña por defecto en XAMPP
$dbname = "inviza"; // Cambia este nombre por el de tu base de datos
>>>>>>> 930ce47964a342f1c23adbe71e71de8b45c0a5f0

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

<<<<<<< HEAD
// Verificar si los datos provienen de JSON o POST
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    // Datos enviados en formato JSON
    $nombre_usuario = isset($data['nombre_usuario']) ? htmlspecialchars($data['nombre_usuario'], ENT_QUOTES, 'UTF-8') : '';
    $documento = isset($data['documento']) ? htmlspecialchars($data['documento'], ENT_QUOTES, 'UTF-8') : '';
    $correo = isset($data['correo']) ? filter_var($data['correo'], FILTER_VALIDATE_EMAIL) : '';
    $telefono = isset($data['telefono']) ? htmlspecialchars($data['telefono'], ENT_QUOTES, 'UTF-8') : '';
    $rol = isset($data['rol']) ? htmlspecialchars($data['rol'], ENT_QUOTES, 'UTF-8') : '';
    $password = isset($data['password']) ? htmlspecialchars($data['password'], ENT_QUOTES, 'UTF-8') : '';
} else {
    // Datos enviados en formato POST
    $nombre_usuario = isset($_POST['nombre_usuario']) ? htmlspecialchars($_POST['nombre_usuario'], ENT_QUOTES, 'UTF-8') : '';
    $documento = isset($_POST['documento']) ? htmlspecialchars($_POST['documento'], ENT_QUOTES, 'UTF-8') : '';
    $correo = isset($_POST['correo']) ? filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL) : '';
    $telefono = isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8') : '';
    $rol = isset($_POST['rol']) ? htmlspecialchars($_POST['rol'], ENT_QUOTES, 'UTF-8') : '';
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8') : '';
}

// Validaciones básicas
=======
// Capturar y sanitizar los datos enviados por el formulario
$nombre_usuario = filter_input(INPUT_POST, 'nombre_usuario', FILTER_SANITIZE_STRING);
$documento = filter_input(INPUT_POST, 'documento', FILTER_SANITIZE_STRING);
$correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
$rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// Validaciones básicas en el servidor
>>>>>>> 930ce47964a342f1c23adbe71e71de8b45c0a5f0
if (empty($nombre_usuario) || empty($documento) || empty($correo) || empty($rol) || empty($password)) {
    die("Error: Todos los campos obligatorios deben completarse.");
}

if (!$correo) {
    die("Error: El correo electrónico no es válido.");
}

// Encriptar la contraseña antes de almacenarla
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Usar una sentencia preparada para insertar los datos en la tabla
$stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, documento, correo, telefono, rol, password) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nombre_usuario, $documento, $correo, $telefono, $rol, $hashedPassword);

if ($stmt->execute()) {
    echo "Registro exitoso.";
} else {
    echo "Error al registrar: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
