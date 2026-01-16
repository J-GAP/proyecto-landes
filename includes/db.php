<?php
// includes/db.php

// Configuración de la Base de Datos
$host = 'localhost';
$dbname = 'landes_db';
$username = 'root';
$password = '';

try {
    // Crear conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Configurar el modo de error de PDO para que lance excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Configurar el modo de fetch predeterminado a Array Asociativo
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Si falla, detener todo y mostrar mensaje 
    die("Error de conexión a la Base de Datos: " . $e->getMessage());
}
?>