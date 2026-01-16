<?php
$bd_host = "localhost"; //localhost
$bd_usuario = "root";
$bd_password = "root";
$bd_base = "evimerce";

// Conexión a BD usando PDO
try {
    $pdo = new PDO('mysql:host=' . $bd_host . ';dbname=' . $bd_base, $bd_usuario, $bd_password);
    $pdo->exec("set names utf8");
    $pdo->exec("SET lc_time_names = 'es_ES';");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Se ha producido un error al conectar: " . $e->getMessage();
}
