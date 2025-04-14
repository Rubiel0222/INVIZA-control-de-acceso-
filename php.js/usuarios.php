<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Usuario predeterminado en XAMPP
$password_db = ""; // Contraseña predeterminada (vacía) en XAMPP
$database = "inviza"; // Nombre de la base de datos

$conn = new mysqli($servername, $username, $password_db, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Capturar y sanitizar los datos del formulario
$nombre_apellido = filter_input(INPUT_POST, 'nombre_apellido', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// Validar los campos
if (empty($nombre_apellido) || empty($email) || empty($usuario) || empty($password)) {
    die("Error: Todos los campos son obligatorios.");
}

if (!$email) {
    die("Error: El correo electrónico no es válido.");
}

// Encriptar la contraseña antes de guardarla
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insertar datos en la base de datos usando una sentencia preparada
$stmt = $conn->prepare("INSERT INTO usuario (nombre_apellido, email, usuario, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre_apellido, $email, $usuario, $hashedPassword);

if ($stmt->execute()) {
    echo "Registro exitoso.";
} else {
    echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
