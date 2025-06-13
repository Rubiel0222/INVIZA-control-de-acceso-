<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "inviza";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST["documento"];
    $nombres = $_POST["nombres"];
    $sucursales = $_POST["sucursales"];
    $zona = $_POST["zona"];
    $estado = $_POST["estado"];
    $fecha_inicio = date("Y-m-d H:i:s", strtotime($_POST["fecha_inicio"]));
    $fecha_fin = date("Y-m-d H:i:s", strtotime($_POST["fecha_fin"]));


    // Consulta para insertar datos
    $sql = "INSERT INTO funcionarios (documento, nombres, sucursales, zona, estado, fecha_inicio, fecha_fin) 
            VALUES ('$documento', '$nombres', '$sucursales', '$zona', '$estado', '$fecha_inicio', '$fecha_fin')";

    if ($conn->query($sql) === TRUE) {
        echo "Funcionario guardado correctamente.";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

?>
