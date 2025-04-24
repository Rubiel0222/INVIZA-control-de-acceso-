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

// Validar claves 'estado' y 'arl' en $_GET
$estado = isset($_GET['estado']) ? $_GET['estado'] : null; // Validación con isset()
$arl = isset($_GET['arl']) ? $_GET['arl'] : null;          // Validación con isset()

// Alternativamente, usando el operador de fusión nula
$estado = $_GET['estado'] ?? null; // Validación más simple
$arl = $_GET['arl'] ?? null;       // Validación más simple

// Depuración: Imprimir el contenido de $_GET para verificar los datos recibidos
print_r($_GET);

// Función para listar visitas
function listarVisitas($conn) {
    $sql = "SELECT * FROM visitas ORDER BY fecha_ingreso DESC"; // Ordenar por fecha descendente
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td contenteditable='true'>{$row['documento']}</td>
                    <td contenteditable='true'>{$row['nombres']}</td>
                    <td contenteditable='true'>{$row['apellidos']}</td>
                    <td contenteditable='true'>{$row['fecha_ingreso']}</td>
                    <td contenteditable='true'>{$row['fecha_fin']}</td>
                     <td contenteditable='true'>{$row['estado_visita']}</td> 
                    <td contenteditable='true'>{$row['arl_checkbox']}</td> 
                    <td contenteditable='true'>{$row['placa']}</td>
                    <td contenteditable='true'>{$row['id_zona']}</td>
                    <td>
                        <button class='edit-button' onclick=\"editarVisita('{$row['documento']}')\">Editar</button>
                        <button class='delete-button' onclick=\"eliminarVisita('{$row['documento']}')\">Borrar</button>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No hay visitas registradas</td></tr>";
    }
}

// Manejo de envíos POST para actualizar información
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $documento = $_POST['documento'] ?? '';
    $nombres = $_POST['nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $fecha_ingreso = $_POST['fecha_ingreso'] ?? '';
    $fecha_fin = $_POST['fecha_fin'] ?? '';
    $estado = $_POST['estado'] ?? 'pendiente'; // Valor predeterminado
    $arl = $_POST['arl'] ?? 0;                 // Valor predeterminado
    $placa = $_POST['placa'] ?? '';
    $id_zona = $_POST['id_zona'] ?? '';

    // Solo proceder si 'numero_documento' tiene un valor
    if (!empty($documento)) {
        $sql = "UPDATE visitas 
                SET nombres = '$nombres', 
                    apellidos = '$apellidos', 
                    fecha_ingreso = '$fecha_ingreso', 
                    fecha_fin = '$fecha_fin', 
                    estado = '$estado', 
                    arl = '$arl', 
                    placa = '$placa', 
                    id_zona = '$id_zona' 
                WHERE documento = '$documento'";

        if ($conn->query($sql) === TRUE) {
            echo "Registro actualizado correctamente";
        } else {
            echo "Error al actualizar: " . $conn->error;
        }
    } else {
        echo "Número de documento no proporcionado.";
    }
}
?>

<!-- Contenedor de la tabla -->
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Documento</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>fecha_ingreso</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>ARL</th>
                <th>placa</th>
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
