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
$nombre_apellido = isset($_POST['nombre_apellido']) ? htmlspecialchars(trim($_POST['nombre_apellido']), ENT_QUOTES, 'UTF-8') : null;
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) : null;
$usuario = isset($_POST['usuario']) ? htmlspecialchars(trim($_POST['usuario']), ENT_QUOTES, 'UTF-8') : null;
$password = isset($_POST['password']) ? htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8') : null;

// Validar los campos obligatorios
if (empty($nombre_apellido) || empty($email) || empty($usuario) || empty($password)) {
    die("Error: Todos los campos son obligatorios.");
}

if (!$email) {
    die("Error: El correo electrónico no es válido.");
}

// Encriptar la contraseña antes de guardarla
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Usar una sentencia preparada para insertar los datos en la base de datos
$stmt = $conn->prepare("INSERT INTO usuario (nombre_apellido, email, usuario, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre_apellido, $email, $usuario, $hashedPassword);

if ($stmt->execute()) {
    echo "Registro exitoso.";
} else {
    echo "Error al registrar: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
