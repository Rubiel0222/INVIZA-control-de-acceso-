<?php
// Datos para la conexión
$servername = "localhost"; // Servidor local
$username = "root"; // Usuario por defecto de XAMPP
$password = ""; // Contraseña por defecto en XAMPP
$dbname = "inviza"; // Cambia este nombre por el de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $documento = $_POST['documento'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $estado_visita = $_POST['estado_visita'];
    $arl_checkbox = isset($_POST['arl_checkbox']) ? 1 : 0;
    $ingresos = !empty($_POST['ingresos']) ? $_POST['ingresos'] : null;
    $empresa_origen = !empty($_POST['empresa_origen']) ? $_POST['empresa_origen'] : null;
    $observaciones = !empty($_POST['observaciones']) ? $_POST['observaciones'] : null;
    $id_zona = !empty($_POST['id_zona']) ? $_POST['id_zona'] : null;

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO visitas (numero_documento, nombres, apellidos, fecha_inicio, fecha_fin, estado_visita, arl_checkbox, ingresos, empresa_origen, observaciones, id_zona)
            VALUES ('$documento', '$nombres', '$apellidos', '$fecha_inicio', '$fecha_fin', '$estado_visita', $arl_checkbox, $ingresos, '$empresa_origen', '$observaciones', $id_zona)";

    if ($conn->query($sql) === TRUE) {
        echo "Información guardada con éxito";
        header("Location: visitas_creación y edición.html"); // Redirige a otra página tras guardar
        exit();
    } else {
        echo "Error al guardar la información: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
