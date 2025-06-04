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

// Consultar datos de visitas (última por documento)
$sql = "SELECT * FROM visitas v1 
        WHERE fecha_ingreso = (SELECT MAX(fecha_ingreso) FROM visitas v2 WHERE v2.documento = v1.documento) 
        ORDER BY fecha_ingreso DESC";

$result = $conn->query($sql);

// Mostrar registros si existen
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['documento']}</td>
                <td>{$row['nombres']}</td>
                <td>{$row['apellidos']}</td>
                <td>{$row['fecha_ingreso']}</td>
                <td>{$row['fecha_fin']}</td>
                <td>{$row['estado_visita']}</td>
                <td>{$row['arl_checkbox']}</td>
                <td>{$row['placa']}</td>
                <td>{$row['id_zona']}</td>
                <td>
                    <button class='edit-button' onclick=\"editarVisita('{$row['documento']}')\">Editar</button>
                    <button class='delete-button' onclick=\"eliminarVisita('{$row['documento']}')\">Borrar</button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='10'>No hay visitas registradas</td></tr>";
}

// Cerrar conexión
$conn->close();
?>
