<?php
$host = "localhost";
$user = "root";  // Por defecto en XAMPP
$pass = "";      // Sin contraseña en XAMPP por defecto
$dbname = "facturacion";

$conn = new mysqli($host, $user, $pass, $dbname);
$conn->set_charset("utf8mb4");
header('Content-Type: text/html; charset=UTF-8');




if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
