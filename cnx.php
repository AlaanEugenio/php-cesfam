<?php
$titulo = "Hola ";

// Configuración de la base de datos
$servidor = 'localhost'; // o la dirección de tu servidor de base de datos
$bd_nombre = 'llamadas_db'; // El nombre de tu base de datos
$usuario = 'root'; // Tu usuario de la BD
$clave = ""; // Tu contraseña

try {
    $bd = new PDO("mysql:host=$servidor;dbname=$bd_nombre;charset=utf8", $usuario, $clave);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
