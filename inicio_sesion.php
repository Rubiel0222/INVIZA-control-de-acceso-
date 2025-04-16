<?php
// Iniciar la sesión
session_start();

// Configuración de la conexión a la base de datos
$servername = "localhost"; // Servidor (por defecto en XAMPP)
$username_db = "root"; // Usuario MySQL (generalmente 'root' en XAMPP)
$password_db = ""; // Contraseña MySQL (por defecto es vacía en XAMPP)
$dbname = "inviza"; // Nombre de tu base de datos

// Crear conexión con MySQL
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Capturar datos en JSON o POST
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    // Datos enviados en formato JSON
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';
} else {
    // Datos enviados mediante formulario POST
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
}

// Preparar la consulta SQL para buscar el usuario
$stmt = $conn->prepare("SELECT password, rol FROM usuarios WHERE nombre_usuario = ?");
$stmt->bind_param("s", $username); // Vincula el parámetro (nombre de usuario)
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($db_password, $rol);
    $stmt->fetch();

    // Verificar si la contraseña ingresada coincide (usa password_verify para seguridad)
    if (password_verify($password, $db_password)) {
        // Guardar información en la sesión
        $_SESSION["nombre_usuario"] = $username;
        $_SESSION["rol"] = $rol;

        // Redirigir a la página principal
        header("location:pagina_inicial.html");
        exit();
    } else {
        // Contraseña incorrecta
        echo "<script>
                alert('Contraseña incorrecta.');
                window.history.back();
              </script>";
    }
} else {
    // Usuario no encontrado
    echo "<script>
            alert('Usuario no encontrado.');
            window.history.back();
          </script>";
}

$stmt->close();
$conn->close();
?>
