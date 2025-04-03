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

    if ($stmt->execute()) {
        echo "Visita creada exitosamente.";
    } else {
        echo "Error al crear visita: " . $stmt->error;
    }

    $stmt->close();
}

// Recuperar datos para mostrarlos en la tabla
$result = $conn->query("SELECT * FROM visitas");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id_visitas']}</td>
            <td contenteditable='true'>{$row['id_usuario']}</td>
            <td contenteditable='true'>{$row['fecha_inicio']}</td>
            <td contenteditable='true'>{$row['fecha_fin']}</td>
            <td contenteditable='true'>{$row['estado_visita']}</td>
            <td contenteditable='true'>{$row['sucursal']}</td>
            <td contenteditable='true'>{$row['fecha_ingreso']}</td>
            <td contenteditable='true'>{$row['id_zona']}</td>
            <td contenteditable='true'>{$row['hora_ingreso']}</td>
            <td contenteditable='true'>{$row['numero_documento']}</td>
            <td>
                <button class='edit-button'>Editar</button>
                <button class='delete-button'>Borrar</button>
                <button class='movements-button'>Movimientos</button>
                <button class='save-button' style='display: none;'>Guardar</button>
            </td>
        </tr>";
    }
}

$conn->close();
?>
