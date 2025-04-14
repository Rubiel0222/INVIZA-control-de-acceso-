<?php
// Incluir conexión a la base de datos
include 'conexion.php';

// Validar y obtener datos del formulario
$documento = $_POST['documento'];

// Lógica para verificar la visita y registrar ingreso
$query = "SELECT * FROM visitas 
          WHERE numero_documento = '$documento' 
          AND fecha_inicio <= NOW() 
          AND fecha_fin >= NOW() 
          AND estado_visita = 'activa'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $zona_id = $row['id_zona'];

    $insert_query = "INSERT INTO visitantes (numero_documento, hora_ingreso, id_zona) 
                     VALUES ('$documento', NOW(), '$zona_id')";
    if (mysqli_query($conn, $insert_query)) {
        echo "Ingreso registrado correctamente.";
    } else {
        echo "Error al registrar ingreso: " . mysqli_error($conn);
    }
} else {
    echo "Visita no válida o fuera de rango.";
}
?>
