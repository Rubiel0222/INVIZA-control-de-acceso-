<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["error" => "Conexión fallida: " . $conn->connect_error]));
}

// Asegurar que la respuesta sea JSON
header('Content-Type: application/json');

// **Procesar actualización de datos**
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data) {
        $sql = "UPDATE visitas SET 
                    nombres='{$data['nombres']}', 
                    apellidos='{$data['apellidos']}', 
                    fecha_ingreso='{$data['fecha_ingreso']}', 
                    fecha_fin='{$data['fecha_fin']}',
                    estado_visita='{$data['estado_visita']}',
                    arl_checkbox='{$data['arl_checkbox']}',
                    placa='{$data['placa']}',
                    id_zona='{$data['id_zona']}'
                WHERE documento='{$data['documento']}'";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["mensaje" => "✅ Registro actualizado correctamente"]);
        } else {
            echo json_encode(["error" => "❌ Error al actualizar: " . $conn->error]);
        }
    }
    exit();
}

// **Consulta de datos**
$sql = "SELECT * FROM visitas v1 
        WHERE fecha_ingreso = (SELECT MAX(fecha_ingreso) FROM visitas v2 WHERE v2.documento = v1.documento) 
        ORDER BY fecha_ingreso DESC";

$result = $conn->query($sql);

$datos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }
}

echo json_encode($datos);

// Cerrar conexión
$conn->close();
?>
