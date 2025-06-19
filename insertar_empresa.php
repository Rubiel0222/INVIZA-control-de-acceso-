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
    die("Conexión fallida: " . $conn->connect_error);
}

// Validar y capturar los datos del formulario
$nombre    = isset($_POST['nombre_empresa']) ? $_POST['nombre_empresa'] : '';
$nit       = isset($_POST['nit']) ? $_POST['nit'] : '';
$telefono  = isset($_POST['telefono_empresa']) ? $_POST['telefono_empresa'] : '';
$direccion = isset($_POST['direccion_empresa']) ? $_POST['direccion_empresa'] : '';

// Verificar que no estén vacíos
if ($nombre && $nit && $telefono && $direccion) {
    $sql = "INSERT INTO empresa (nombre_empresa, nit, telefono_empresa, direccion_empresa)
            VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssss", $nombre, $nit, $telefono, $direccion);
        if ($stmt->execute()) {
            echo "Registro guardado exitosamente";
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
} else {
    echo "Por favor completa todos los campos obligatorios.";
}

$conn->close();
?>

