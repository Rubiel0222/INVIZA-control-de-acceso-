<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "inviza";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar datos del formulario    
    $documento = isset($_POST["documento"]) ? mysqli_real_escape_string($conn, $_POST["documento"]) : "";
    $nombres = isset($_POST["nombres"]) ? mysqli_real_escape_string($conn, $_POST["nombres"]) : "";
    $sucursales = isset($_POST["sucursales"]) ? mysqli_real_escape_string($conn, $_POST["sucursales"]) : "";
    $zona = isset($_POST["zona"]) ? mysqli_real_escape_string($conn, $_POST["zona"]) : "";
    $estado = isset($_POST["estado"]) ? mysqli_real_escape_string($conn, $_POST["estado"]) : "";
    $fecha_inicio = isset($_POST["fecha_inicio"]) ? date("Y-m-d H:i:s", strtotime($_POST["fecha_inicio"])) : NULL;
    $fecha_fin = isset($_POST["fecha_fin"]) && !empty($_POST["fecha_fin"]) ? date("Y-m-d H:i:s", strtotime($_POST["fecha_fin"])) : NULL;

    // Verificar datos antes de la inserción
    var_dump($_POST);
    
    // Validar que los campos obligatorios no estén vacíos
    if (empty($documento) || empty($nombres) || empty($fecha_inicio)) {
        die("Error: Todos los campos obligatorios deben completarse.");
    }

    // Preparar consulta SQL con valores seguros
    $sql = "INSERT INTO funcionarios (documento, nombres, sucursales, zona, estado, fecha_inicio, fecha_fin) 
            VALUES ('$documento', '$nombres', '$sucursales', '$zona', '$estado', '$fecha_inicio', " . ($fecha_fin ? "'$fecha_fin'" : "NULL") . ")";

    if ($conn->query($sql) === TRUE) {
        echo "Funcionario guardado correctamente.";
    } else {
        echo "Error al guardar: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>
