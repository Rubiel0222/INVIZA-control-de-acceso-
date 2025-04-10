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
    $sql = "SELECT * FROM visitas ORDER BY fecha_inicio DESC"; // Ordenar por fecha descendente
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td contenteditable='true'>{$row['numero_documento']}</td>
                    <td contenteditable='true'>{$row['nombres']}</td>
                    <td contenteditable='true'>{$row['apellidos']}</td>
                    <td contenteditable='true'>{$row['fecha_inicio']}</td>
                    <td contenteditable='true'>{$row['fecha_fin']}</td>
                    <td contenteditable='true'>{$row['estado']}</td>
                    <td contenteditable='true'>{$row['arl']}</td>
                    <td contenteditable='true'>{$row['observaciones']}</td>
                    <td contenteditable='true'>{$row['id_zona']}</td>
                    <td>
                        <button class='edit-button' onclick=\"editarVisita('{$row['numero_documento']}')\">Editar</button>
                        <button class='delete-button' onclick=\"eliminarVisita('{$row['numero_documento']}')\">Borrar</button>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No hay visitas registradas</td></tr>";
    }
}

// Manejar envíos POST para actualizar información
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['numero_documento'])) {
        $documento = $_POST['numero_documento'];
        $nombres = $_POST['nombres'] ?? ''; // Validar clave
        $apellidos = $_POST['apellidos'] ?? ''; // Validar clave
        $fecha_inicio = $_POST['fecha_inicio'] ?? ''; // Validar clave
        $fecha_fin = $_POST['fecha_fin'] ?? ''; // Validar clave
        $estado = $_POST['estado'] ?? 'pendiente'; // Usar valor por defecto si falta
        $arl = $_POST['arl'] ?? 0; // Usar valor por defecto si falta
        $observaciones = $_POST['observaciones'] ?? ''; // Validar clave
        $id_zona = $_POST['id_zona'] ?? ''; // Validar clave

        // Actualizar datos en la base de datos
        $sql = "UPDATE visitas SET nombres='$nombres', apellidos='$apellidos', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin', estado='$estado', arl='$arl', observaciones='$observaciones', id_zona='$id_zona' WHERE numero_documento='$documento'";
        if ($conn->query($sql) === TRUE) {
            echo "Registro actualizado correctamente";
        } else {
            echo "Error al actualizar: " . $conn->error;
        }
    }
}
?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Documento</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>ARL</th>
                <th>Observaciones</th>
                <th>ID Zona</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php listarVisitas($conn); ?>
        </tbody>
    </table>
</div>

<?php
// Cerrar conexión
$conn->close();
?>
