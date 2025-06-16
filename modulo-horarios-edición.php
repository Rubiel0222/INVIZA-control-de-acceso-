<?php
$servername = "localhost";
$username = "root"; 
$password = "";  
$database = "inviza";  

// Conectar a MySQL
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error en la conexión: " . $conn->connect_error);
}

// Solo ejecutar si hay una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos y validar que existen
    $nombre_horario = isset($_POST["nombre_horario"]) ? trim($_POST["nombre_horario"]) : null;
    $gabela = isset($_POST["gabela"]) ? trim($_POST["gabela"]) : null;
    $estado = isset($_POST["estado"]) ? trim($_POST["estado"]) : null;
    $horas_laborales = isset($_POST["horas_laborales"]) ? trim($_POST["horas_laborales"]) : null;
    $aplicar_horas = isset($_POST["aplicar_horas"]) ? 1 : 0; // Si está marcado es 1, si no es 0

    // Validar campos obligatorios
    if (empty($nombre_horario) || empty($gabela) || empty($estado) || empty($horas_laborales)) {
       
    }

    // Preparar consulta SQL segura para evitar inyección de código
    $sql = "INSERT INTO horarios (nombre, tiempo_gabela, aplicar_horas, estado, horas_laborales) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sisss", $nombre_horario, $gabela, $aplicar_horas, $estado, $horas_laborales);
        
        if ($stmt->execute()) {
            echo "✅ Horario guardado correctamente.";
        } else {
            echo "❌ Error al guardar el horario: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "❌ Error en la preparación de la consulta: " . $conn->error;
    }

    $conn->close();
}
?>
