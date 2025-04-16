<<<<<<< HEAD
<<<<<<< HEAD
<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root"; // Usuario predeterminado
$password_db = ""; // Contraseña predeterminada
$database = "inviza"; // Nombre de tu base de datos

$conn = new mysqli($servername, $username, $password_db, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar un nuevo registro como prueba
$sql = "INSERT INTO usuario (nombre_apellido, email, usuario, password) 
        VALUES ('rubiel quintero', 'rubiel@example.com', 'rubeilq', 'hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Registro agregado correctamente.";
} else {
    echo "Error: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
=======
=======
>>>>>>> 930ce47964a342f1c23adbe71e71de8b45c0a5f0
<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root"; // Usuario predeterminado
$password_db = ""; // Contraseña predeterminada
$database = "inviza"; // Nombre de tu base de datos

$conn = new mysqli($servername, $username, $password_db, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar un nuevo registro como prueba
$sql = "INSERT INTO usuario (nombre_apellido, email, usuario, password) 
        VALUES ('rubiel quintero', 'rubiel@example.com', 'rubeilq', 'hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Registro agregado correctamente.";
} else {
    echo "Error: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
<<<<<<< HEAD
>>>>>>> 930ce47 (Actualiza repositorio con los últimos cambios)
=======
>>>>>>> 930ce47964a342f1c23adbe71e71de8b45c0a5f0
