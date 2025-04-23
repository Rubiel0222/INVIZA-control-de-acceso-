<?php
session_start();

// Configuración de la base de datos usando PDO
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "inviza";

// Encabezados para JSON y CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username_db, $password_db, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Error de conexión"]);
    exit();
}

// Capturar los datos en JSON y verificar si llegaron correctamente
$data = json_decode(file_get_contents("php://input"), true);
file_put_contents("log.txt", json_encode($data, JSON_PRETTY_PRINT), FILE_APPEND);

if (!$data || empty($data['nombre_usuario']) || empty($data['password'])) {
    echo json_encode(["status" => "error", "message" => "Usuario y contraseña son requeridos"]);
    exit();
}

$nombre_usuario = trim($data['nombre_usuario']);
$password = trim($data['password']);

// **Depuración adicional**: Guardar los datos recibidos
file_put_contents("debug_log.txt", json_encode(["Usuario recibido" => $nombre_usuario, "Contraseña recibida" => $password], JSON_PRETTY_PRINT), FILE_APPEND);

// Consulta segura con PDO
$stmt = $conn->prepare("SELECT password, rol FROM usuarios WHERE nombre_usuario = ?");
$stmt->execute([$nombre_usuario]);

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    $db_password = $row['password'];
    $rol = $row['rol'];

    // **Depuración**: Verificar la contraseña guardada en la BD antes de compararla
    file_put_contents("debug_log.txt", json_encode(["Contraseña en BD" => $db_password], JSON_PRETTY_PRINT), FILE_APPEND);

    // **Verificar si la contraseña en la BD está hasheada**
    if (password_verify($password, $db_password)) {
        $_SESSION["nombre_usuario"] = $nombre_usuario;
        $_SESSION["rol"] = $rol;

        echo json_encode(["status" => "success", "message" => "Inicio de sesión exitoso", "rol" => $rol]);
    } else {
        // Si la contraseña está en texto plano, actualizarla a una versión hasheada
        if ($db_password === $password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt_update = $conn->prepare("UPDATE usuarios SET password = ? WHERE nombre_usuario = ?");
            $stmt_update->execute([$hashed_password, $nombre_usuario]);

            echo json_encode(["status" => "success", "message" => "Contraseña actualizada a formato seguro. Inicia sesión nuevamente.", "rol" => $rol]);
        } else {
            echo json_encode(["status" => "error", "message" => "Contraseña incorrecta"]);
        }
    }
} else {
    echo json_encode(["status" => "error", "message" => "Usuario no encontrado"]);
}
?>
