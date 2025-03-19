<?php
// Datos para la conexión
$servername = "localhost"; // Servidor local
$username = "root"; // Usuario por defecto de XAMPP
$password = ""; // Contraseña por defecto en XAMPP
$dbname = "inviza"; // Cambia este nombre por el de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Capturar y sanitizar los datos enviados por el formulario
$nombre_usuario = filter_input(INPUT_POST, 'nombre_usuario', FILTER_SANITIZE_STRING);
$documento = filter_input(INPUT_POST, 'documento', FILTER_SANITIZE_STRING);
$correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
$rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// Validaciones básicas en el servidor
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
