<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_victor";

try {
    // Crear conexión con PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Establecer el modo de error de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Si ocurre un error, mostrar el mensaje
    echo "Conexión fallida: " . $e->getMessage();
}

define("LEER_MAS", "Leer más");

?>