<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Detectar si la solicitud es para actualizar o para consultar
$request_method = $_SERVER["REQUEST_METHOD"];

if ($request_method === "POST") {
    // Actualizar registro existente
    $data = json_decode(file_get_contents("php://input"), true);
    
    $sql = "UPDATE visitas SET 
            nombres = '{$data['nombres']}', 
            apellidos = '{$data['apellidos']}', 
            fecha_ingreso = '{$data['fecha_ingreso']}', 
            fecha_fin = '{$data['fecha_fin']}', 
            estado_visita = '{$data['estado_visita']}', 
            arl_checkbox = '{$data['arl_checkbox']}', 
            placa = '{$data['placa']}', 
            id_zona = '{$data['id_zona']}' 
            WHERE documento = '{$data['documento']}'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["mensaje" => "Registro actualizado con éxito"]);
    } else {
        echo json_encode(["error" => "Error al actualizar: " . $conn->error]);
    }
} else if ($request_method === "GET") {
    // Consultar registros
    $sql = "SELECT * FROM visitas v1 
            WHERE fecha_ingreso = (SELECT MAX(fecha_ingreso) FROM visitas v2 WHERE v2.documento = v1.documento) 
            ORDER BY fecha_ingreso DESC";

    $result = $conn->query($sql);
    $visitas = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $visitas[] = $row;
        }
    }

    echo json_encode($visitas);
}

$conn->close();
?>
