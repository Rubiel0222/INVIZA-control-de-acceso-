<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$query = "SELECT * FROM lista_negra ORDER BY fecha_registro DESC";
$resultado = $conexion->query($query);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$fila['id_lista_negra']}</td>
                <td>{$fila['documento']}</td>
                <td>{$fila['nombres']}</td>
                <td>{$fila['apellidos']}</td>
                <td>{$fila['tipo']}</td>
                <td>{$fila['motivo']}</td>
                <td>{$fila['fecha_registro']}</td>
                <td>{$fila['ESTADO']}</td>
                <td>
                  <button class='btn btn-warning btn-sm'>Editar</button>
                  <button class='btn btn-danger btn-sm'>Borrar</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='9'>No hay registros en la lista negra.</td></tr>";
}
$conexion->close();
?>
