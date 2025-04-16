<<<<<<< HEAD
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
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Detectar si los datos vienen en JSON o desde un formulario POST
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data) {
        // Capturar datos en formato JSON
        $tipo_documento = $data['tipo_documento'] ?? null;
        $numero_documento = $data['numero_documento'] ?? null;
        $nombres_apellidos = $data['nombres_apellidos'] ?? null;
        $telefono = $data['telefono'] ?? null;
        $vehiculo = $data['vehiculo'] ?? null;
        $observaciones = $data['observaciones'] ?? null;
        $visita_a = $data['visita_a'] ?? null;
        $foto_base64 = $data['foto'] ?? null;
        $id_zona = $data['id_zona'] ?? null;
    } else {
        // Capturar datos enviados desde el formulario
        $tipo_documento = $_POST['tipo_documento'] ?? null;
        $numero_documento = $_POST['numero_documento'] ?? null;
        $nombres_apellidos = $_POST['nombres_apellidos'] ?? null;
        $telefono = $_POST['telefono'] ?? null;
        $vehiculo = $_POST['vehiculo'] ?? null;
        $observaciones = $_POST['observaciones'] ?? null;
        $visita_a = $_POST['visita_a'] ?? null;
        $foto_base64 = $_POST['foto'] ?? null;
        $id_zona = $_POST['id_zona'] ?? null;
    }

    // Registrar hora actual
    $hora_actual = date("Y-m-d H:i:s");

    // Revisar si el documento ya existe en la base de datos
    $query_check = "SELECT id FROM visitantes WHERE numero_documento = '$numero_documento' AND hora_salida IS NULL";
    $result_check = $conn->query($query_check);

    if ($result_check->num_rows > 0) {
        // Actualizar la hora de salida para el registro existente
        $sql = "UPDATE visitantes SET hora_salida = '$hora_actual' WHERE numero_documento = '$numero_documento' AND hora_salida IS NULL";
        if ($conn->query($sql) === TRUE) {
            echo "Hora de salida registrada correctamente.";
        } else {
            echo "Error al registrar la hora de salida: " . $conn->error;
        }
    } else {
        // Procesar la imagen Base64
        if (!empty($foto_base64)) {
            $foto_base64 = str_replace('data:image/jpg;base64,', '', $foto_base64);
            $foto_base64 = str_replace(' ', '+', $foto_base64);
            $fotoDecodificada = base64_decode($foto_base64);
            $nombreArchivo = 'uploads/' . uniqid() . '.jpg';

            // Crear la carpeta 'uploads' si no existe
            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            // Guardar la imagen decodificada en el servidor
            if (!file_put_contents($nombreArchivo, $fotoDecodificada)) {
                die("Error al guardar la imagen.");
            }
        } else {
            $nombreArchivo = null; // Si no se recibe imagen, asignar null
        }

        // Insertar un nuevo registro en la base de datos
        $sql = "INSERT INTO visitantes (tipo_documento, numero_documento, nombres_apellidos, telefono, vehiculo, observaciones, visita_a, foto, id_zona, hora_ingreso)
                VALUES ('$tipo_documento', '$numero_documento', '$nombres_apellidos', '$telefono', '$vehiculo', '$observaciones', '$visita_a', '$nombreArchivo', '$id_zona', '$hora_actual')";
        if ($conn->query($sql) === TRUE) {
            echo "Registro insertado correctamente.";
        } else {
            echo "Error al insertar el registro: " . $conn->error;
        }
    }
}

// Cerrar la conexión
$conn->close();
?>
=======
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
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar datos del formulario
    $tipo_documento = $_POST['tipo_documento'] ?? null;
    $numero_documento = $_POST['numero_documento'] ?? null;
    $nombres_apellidos = $_POST['nombres_apellidos'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $vehiculo = $_POST['vehiculo'] ?? null;
    $observaciones = $_POST['observaciones'] ?? null;
    $visita_a = $_POST['visita_a'] ?? null;
    $foto_base64 = $_POST['foto'] ?? null;
    $id_zona = $_POST['id_zona'] ?? null;
    $hora_actual = date("Y-m-d H:i:s");

    // Revisar si el documento ya existe en la base de datos
    $query_check = "SELECT id FROM visitantes WHERE numero_documento = '$numero_documento' AND hora_salida IS NULL";
    $result_check = $conn->query($query_check);

    if ($result_check->num_rows > 0) {
        // Actualizar la hora de salida para el registro existente
        $sql = "UPDATE visitantes SET hora_salida = '$hora_actual' WHERE numero_documento = '$numero_documento' AND hora_salida IS NULL";
        if ($conn->query($sql) === TRUE) {
            echo "Hora de salida registrada correctamente.";
        } else {
            echo "Error al registrar la hora de salida: " . $conn->error;
        }
    } else {
        // Procesar la imagen Base64
        if (!empty($foto_base64)) {
            $foto_base64 = str_replace('data:image/jpg;base64,', '', $foto_base64);
            $foto_base64 = str_replace(' ', '+', $foto_base64);
            $fotoDecodificada = base64_decode($foto_base64);
            $nombreArchivo = 'uploads/' . uniqid() . '.jpg';

            // Crear la carpeta 'uploads' si no existe
            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            // Guardar la imagen decodificada en el servidor
            if (!file_put_contents($nombreArchivo, $fotoDecodificada)) {
                die("Error al guardar la imagen.");
            }
        } else {
            $nombreArchivo = null; // Si no se recibe imagen, asignar null
        }

        // Insertar un nuevo registro en la base de datos
        $sql = "INSERT INTO visitantes (tipo_documento, numero_documento, nombres_apellidos, telefono, vehiculo, observaciones, visita_a, foto, id_zona, hora_ingreso)
                VALUES ('$tipo_documento', '$numero_documento', '$nombres_apellidos', '$telefono', '$vehiculo', '$observaciones', '$visita_a', '$nombreArchivo', '$id_zona', '$hora_actual')";
        if ($conn->query($sql) === TRUE) {
            echo "Registro insertado correctamente.";
        } else {
            echo "Error al insertar el registro: " . $conn->error;
        }
    }
}

// Cerrar la conexión
$conn->close();
?>
>>>>>>> 930ce47964a342f1c23adbe71e71de8b45c0a5f0
