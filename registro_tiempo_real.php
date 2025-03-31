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

// Obtener la acción desde la solicitud POST
$accion = isset($_POST['accion']) ? $_POST['accion'] : null;

if ($accion === "dar_salida") {
    // Registrar hora de salida
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $hora_salida = date("Y-m-d H:i:s");

    // Verificar que se haya pasado un ID válido
    if ($id > 0) {
        $sql = "UPDATE visitantes SET hora_salida = '$hora_salida' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["success" => true, "message" => "Hora de salida registrada correctamente."]);
        } else {
            echo json_encode(["error" => "Error al actualizar la hora de salida: " . $conn->error]);
        }
    } else {
        echo json_encode(["error" => "ID inválido para dar salida."]);
    }
} else {
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
}

// Cerrar la conexión
$conn->close();

?>
