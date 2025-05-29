<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "reciclaje_db"; // cambia esto al nombre real de tu base

$conn = new mysqli($host, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>