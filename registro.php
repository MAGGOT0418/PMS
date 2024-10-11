<?php
include 'db.php'; // Incluir la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_email = $_POST['reg-email'];
    $reg_password = $_POST['reg-password'];
    $reg_confirm_password = $_POST['reg-confirm-password'];

    // Aquí puedes agregar la lógica para verificar si el correo ya existe
    // y registrar el nuevo usuario
    if ($reg_password === $reg_confirm_password) {
        $sql = "INSERT INTO usuarios (correo, password) VALUES ('$reg_email', '$reg_password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registro exitoso.";
            // Redirigir a otra página, como el inicio de sesión
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Las contraseñas no coinciden.";
    }
}
?>

