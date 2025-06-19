<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id_empresa, nombre_empresa, nit, telefono_empresa, direccion_empresa FROM empresa";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($fila = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['id_empresa'] . "</td>";
        echo "<td>" . htmlspecialchars($fila['nombre_empresa']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['nit']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['telefono_empresa']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['direccion_empresa']) . "</td>";
        echo "<td>
                <button class='editar' data-id='" . $fila['id_empresa'] . "'>Editar</button>
                <button class='eliminar' data-id='" . $fila['id_empresa'] . "'>Eliminar</button>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No hay empresas registradas.</td></tr>";
}

$conn->close();
?>
