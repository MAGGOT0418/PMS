<?php
include 'db.php'; // Incluir la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Aquí puedes agregar la lógica de verificación de usuario
    $sql = "SELECT * FROM usuarios WHERE correo = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario encontrado, inicia sesión
        session_start();
        $_SESSION['email'] = $email;
        // Redirigir a otra página
        header("Location: dashboard.php");
    } else {
        echo "Correo o contraseña incorrectos.";
    }
}
?>

