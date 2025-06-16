<?php
$servername = "localhost";
$username = "root"; 
$password = "";  
$database = "inviza";  

// Conectar a MySQL
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("❌ Error en la conexión: " . $conn->connect_error);
}

// Consultar datos de la tabla horarios
$sql = "SELECT id_horario, nombre, tiempo_gabela, aplicar_horas, estado, horas_laborales FROM horarios";
$result = $conn->query($sql);

if (!$result) {
    die("❌ Error en la consulta SQL: " . $conn->error);
}

// Convertir los datos a JSON para el uso en JavaScript
$horarios = [];
while ($row = $result->fetch_assoc()) {
    $horarios[] = $row;
}

echo json_encode($horarios);

$conn->close();
?>
