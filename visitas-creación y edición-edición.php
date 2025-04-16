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
    // Recibir los datos del formulario y validar
    $documento = isset($_POST['documento']) ? $_POST['documento'] : null;
    $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : null;
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
    $fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : null;
    $fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
    $estado_visita = isset($_POST['estado_visita']) ? $_POST['estado_visita'] : null;
    $arl_checkbox = isset($_POST['arl_checkbox']) ? $_POST['arl_checkbox'] : 0;
    $ingresos = !empty($_POST['ingresos']) ? $_POST['ingresos'] : null;
    $empresa_origen = !empty($_POST['empresa_origen']) ? $_POST['empresa_origen'] : null;
    $observaciones = !empty($_POST['observaciones']) ? $_POST['observaciones'] : null;
    $id_zona = !empty($_POST['id_zona']) ? $_POST['id_zona'] : null;

    // Utilizar una sentencia preparada para insertar datos
    $sql = $conn->prepare("INSERT INTO visitas (numero_documento, nombres, apellidos, fecha_inicio, fecha_fin, estado_visita, arl_checkbox, ingresos, empresa_origen, observaciones, id_zona) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssssiisss", $documento, $nombres, $apellidos, $fecha_inicio, $fecha_fin, $estado_visita, $arl_checkbox, $ingresos, $empresa_origen, $observaciones, $id_zona);

    if ($sql->execute()) {
        echo "Registro exitoso.";
    } else {
        echo "Error: " . $sql->error;
    }

    $sql->close();
}


    // Insertar los datos en la base de datos
    $sql = "INSERT INTO visitas (numero_documento, nombres, apellidos, fecha_inicio, fecha_fin, estado_visita, arl_checkbox, ingresos, empresa_origen, observaciones, id_zona)
            VALUES ('$documento', '$nombres', '$apellidos', '$fecha_inicio', '$fecha_fin', '$estado_visita', $arl_checkbox, 
            " . ($ingresos !== null ? "'$ingresos'" : "NULL") . ", 
            " . ($empresa_origen !== null ? "'$empresa_origen'" : "NULL") . ", 
            " . ($observaciones !== null ? "'$observaciones'" : "NULL") . ", 
            " . ($id_zona !== null ? "'$id_zona'" : "NULL") . ")";

    if ($conn->query($sql) === TRUE) {
        echo "Información guardada con éxito";
    } else {
        echo "Error al guardar la información: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
