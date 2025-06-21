<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inviza";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta a la base de datos
$query = "SELECT * FROM empresa ORDER BY id_empresa ASC";
$resultado = mysqli_query($conexion, $query);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    echo "<tr><td colspan='6'>Error en la consulta: " . mysqli_error($conexion) . "</td></tr>";
    return;
}

// Mostrar los resultados
if (mysqli_num_rows($resultado) > 0) {
    while ($empresa = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>{$empresa['id_empresa']}</td>";
        echo "<td>{$empresa['nombre_empresa']}</td>";
        echo "<td>{$empresa['nit']}</td>";
        echo "<td>{$empresa['telefono_empresa']}</td>";
        echo "<td>{$empresa['direccion_empresa']}</td>";
        echo "<td>
                <button class='editar' data-id='{$empresa['id_empresa']}'>Editar</button>
                <button class='eliminar' data-id='{$empresa['id_empresa']}'>Eliminar</button>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No hay registros disponibles.</td></tr>";
}
?>
