<?php
$host = 'localhost';
$dbname = 'gabriel_segundas';
$username = 'root';
$password = '';

try {
    $conexion_PDO = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conexion_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    echo "Checa tu base de datos".$e->getMessage();
}
?>