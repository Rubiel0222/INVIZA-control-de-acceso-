<?php
// Configuración de la conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión: " . $conn->connect_error]));
}

// Consultar todos los visitantes ordenados por hora de ingreso
$sql = "SELECT * FROM visitantes ORDER BY hora_ingreso DESC";
$result = $conn->query($sql);

$visitantes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $visitantes[] = $row; // Guardar cada visitante en el arreglo
    }
}

echo json_encode($visitantes); // Devolver los datos como JSON
$conn->close();
?>
