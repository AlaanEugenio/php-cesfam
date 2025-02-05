<?php
session_start();
include 'cnx.php'; // Incluir el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = $_POST['rut'];
    $password = $_POST['password'];

    // Consulta para verificar las credenciales
    $stmt = $bd->prepare("SELECT * FROM funcionarios WHERE rut = :rut AND clave = :password");
    $stmt->bindParam(':rut', $rut);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Credenciales válidas
        $_SESSION['rut'] = $rut;
        header("Location: index.php"); // Redirigir a index.php
        exit();
    } else {
        // Credenciales inválidas
        echo "RUT o contraseña incorrectos.";
    }
}
?>
