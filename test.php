<?php
$conn = new mysqli("localhost", "root", "", "inviza");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>
