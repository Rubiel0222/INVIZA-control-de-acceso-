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

// Consultar datos
$sql = "SELECT id_contratista, nombre_contratista, id_empresa, estado, seguridad_social FROM contratista";
$result = $conn->query($sql);

$contratistas = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $contratistas[] = $row;
    }
}

// Devolver datos en formato JSON
echo json_encode($contratistas);

$conn->close();
?>
