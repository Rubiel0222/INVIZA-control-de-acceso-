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

$query = "SELECT * FROM empresa ORDER BY id_empresa ASC";
$resultado = $conexion->query($query);

if ($resultado->num_rows > 0) {
    while ($empresa = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$empresa['id_empresa']}</td>
                <td>{$empresa['nombre_empresa']}</td>
                <td>{$empresa['nit']}</td>
                <td>{$empresa['telefono_empresa']}</td>
                <td>{$empresa['direccion_empresa']}</td>
                <td>
                  <button class='editar' data-id='{$empresa['id_empresa']}'>Editar</button>
                  <button class='eliminar' data-id='{$empresa['id_empresa']}'>Eliminar</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No hay registros disponibles.</td></tr>";
}
?>
