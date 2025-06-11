<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validar si los datos fueron enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar entradas para evitar SQL Injection
    $destinatario = $conn->real_escape_string($_POST["destinatario"]);
    $propietario = $conn->real_escape_string($_POST["propietario"]);
    $ubicacion = $conn->real_escape_string($_POST["ubicacion"]);
    $telefono = $conn->real_escape_string($_POST["telefono"]);
    $codigo_envio = $conn->real_escape_string($_POST["codigoEnvio"]);
    $entregado_por = $conn->real_escape_string($_POST["entregadoPor"]);
    $descripcion = $conn->real_escape_string($_POST["descripcion"]);
    $enviar_correo = isset($_POST["enviarCorreo"]) ? 1 : 0; // Checkbox

    // Validar que ningún campo esté vacío
    if (empty($destinatario) || empty($propietario) || empty($ubicacion) || empty($telefono) || empty($codigo_envio) || empty($entregado_por) || empty($descripcion)) {
        die("Error: Todos los campos deben ser llenados.");
    }

    // Insertar datos en la tabla correspondencia
    $sql = "INSERT INTO correspondencia (destinatario, propietario, ubicacion, telefono, codigo_envio, entregado_por, descripcion, enviar_correo) 
            VALUES ('$destinatario', '$propietario', '$ubicacion', '$telefono', '$codigo_envio', '$entregado_por', '$descripcion', '$enviar_correo')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro guardado correctamente.";
    } else {
        die("Error en la consulta: " . $conn->error); // Muestra errores en la inserción
    }
}

// Cerrar conexión
$conn->close();
?>
