<?php
// Conexión a la base de datos con datos por defecto
$servername = "localhost"; // Por defecto
$username = "root";        // Usuario por defecto en muchas configuraciones
$password = "";            // Contraseña por defecto (vacía en muchas configuraciones)
$dbname = "pms"; // Cambia esto según tu configuración

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $nombre = $_POST['reg-name'] ?? ''; // Usar el operador null coalescing para evitar undefined index
    $email = $_POST['reg-email'] ?? '';
    $contraseña = $_POST['reg-password']; // Hash de la contraseña
    $rol = $_POST['user-role'] ?? '';
    $fecha_registro = date("Y-m-d H:i:s"); // Fecha y hora actual
    $activo = 1; // Estado activo

    // Prepara la consulta SQL
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña, id_tipo_usuario, fecha_registro, activo) VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    
    // Vincula los parámetros
    $stmt->bind_param("sssssi", $nombre, $email, $contraseña, $rol, $fecha_registro, $activo);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error en el registro: " . $stmt->error;
    }

    // Cierra la declaración y la conexión
    $stmt->close();
}

$conn->close();
?>
