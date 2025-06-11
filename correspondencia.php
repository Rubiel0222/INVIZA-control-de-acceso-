<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar la tabla correspondencia
$sql = "SELECT id_correspondencia, descripcion, id_usuario, id_empresa FROM correspondencia";
$result = $conn->query($sql);

// Validación de error en la consulta
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

// Mostrar datos en la tabla
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["id_correspondencia"]) . "</td>
                <td contenteditable='true'>" . htmlspecialchars($row["descripcion"]) . "</td>
                <td contenteditable='true'>" . htmlspecialchars($row["id_usuario"]) . "</td>
                <td contenteditable='true'>" . htmlspecialchars($row["id_empresa"]) . "</td>
                <td>
                    <button class='edit-button'>Editar</button>
                    <button class='delete-button'>Borrar</button>
                    <button class='save-button' style='display: none;'>Guardar</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay registros</td></tr>";
}

// Cerrar conexión
$conn->close();
?>
