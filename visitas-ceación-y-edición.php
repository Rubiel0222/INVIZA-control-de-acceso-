<?php
// Configuración de la base de datos
$host = "localhost";
$dbname = "inviza";
$username = "root";
$password = "";

// Crear conexión
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para listar visitas
function listarVisitas($conn) {
    $sql = "SELECT * FROM visitas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id_visitas']}</td>
                    <td contenteditable='true'>{$row['nombres']}</td>
                    <td contenteditable='true'>{$row['apellidos']}</td>
                    <td contenteditable='true'>{$row['fecha_inicio']}</td>
                    <td contenteditable='true'>{$row['fecha_fin']}</td>
                    <td contenteditable='true'>{$row['estado']}</td>
                    <td contenteditable='true'>{$row['arl']}</td>
                    <td>
                        <button class='edit-button' onclick=\"editarVisita({$row['id_visitas']})\">Editar</button>
                        <button class='delete-button' onclick=\"eliminarVisita({$row['id_visitas']})\">Borrar</button>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No hay visitas registradas</td></tr>";
    }
}

// Manejar envíos POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id_visitas'])) {
        $id = $_POST['id_visitas'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $estado = $_POST['estado'];
        $arl = $_POST['arl'];

        // Actualizar datos
        $sql = "UPDATE visitas SET nombres='$nombres', apellidos='$apellidos', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin', estado='$estado', arl='$arl' WHERE id_visitas=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Registro actualizado";
        } else {
            echo "Error al actualizar: " . $conn->error;
        }
    }
}

// Cerrar conexión
$conn->close();
?>
