<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejar la inserción segura
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST["id_usuario"];
    $fecha_inicio = $_POST["fecha_inicio"];
    $fecha_fin = $_POST["fecha_fin"];
    $estado_visita = $_POST["estado_visita"];
    $sucursal = $_POST["sucursal"];
    $fecha_ingreso = $_POST["fecha_ingreso"];
    $id_zona = $_POST["id_zona"];
    $hora_ingreso = $_POST["hora_ingreso"];
    $numero_documento = $_POST["numero_documento"];

    // Usar una consulta preparada
    $stmt = $conn->prepare("INSERT INTO visitas (id_usuario, fecha_inicio, fecha_fin, estado_visita, sucursal, fecha_ingreso, id_zona, hora_ingreso, numero_documento) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss", $id_usuario, $fecha_inicio, $fecha_fin, $estado_visita, $sucursal, $fecha_ingreso, $id_zona, $hora_ingreso, $numero_documento);

    if ($stmt->execute() === TRUE) {
        echo "Visita creada exitosamente.";
    } else {
        echo "Error al crear visita: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
