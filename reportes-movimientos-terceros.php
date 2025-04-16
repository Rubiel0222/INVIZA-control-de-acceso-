<?php
// Datos para la conexión
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

// Obtener datos del formulario
$fecha_inicial = $_POST['fecha-inicial'];
$fecha_final = $_POST['fecha-final'];
$empresa = $_POST['empresa'];
$sucursal = $_POST['sucursal'];
$inmueble = $_POST['inmueble'];
$cedula = $_POST['cedula'];
$tipo_informe = $_POST['seleccionar'];

// Consulta SQL base
$sql = "SELECT visitantes.nombre, visitantes.cedula, visitas.fecha_ingreso, visitas.fecha_salida, visitas.inmueble
        FROM visitas
        JOIN visitantes ON visitas.id_visitante = visitantes.id
        WHERE visitas.fecha_ingreso BETWEEN '$fecha_inicial' AND '$fecha_final'";

if (!empty($empresa)) {
    $sql .= " AND visitantes.empresa = '$empresa'";
}

if (!empty($sucursal)) {
    $sql .= " AND visitas.sucursal = '$sucursal'";
}

if (!empty($inmueble)) {
    $sql .= " AND visitas.inmueble = '$inmueble'";
}

if (!empty($cedula)) {
    $sql .= " AND visitantes.cedula = '$cedula'";
}

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar resultados
if ($conn && $result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Nombre</th>
                <th>Cédula</th>
                <th>Fecha de ingreso</th>
                <th>Fecha de salida</th>
                <th>Inmueble</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['nombre']}</td>
                <td>{$row['cedula']}</td>
                <td>{$row['fecha_ingreso']}</td>
                <td>{$row['fecha_salida']}</td>
                <td>{$row['inmueble']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }
    echo "No se encontraron resultados.";
}

$conn->close();
?>
