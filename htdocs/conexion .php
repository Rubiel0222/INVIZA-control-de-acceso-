<<<<<<< HEAD
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>
=======
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>
>>>>>>> 930ce47 (Actualiza repositorio con los últimos cambios)
