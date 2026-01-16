<?php
$bd_host = "localhost"; //localhost
$bd_usuario = "root";
$bd_password = "root";
$bd_base = "evimerce";

// Conexión a BD usando PDO
try {
    $pdo = new PDO('mysql:host=' . $bd_host . ';dbname=' . $bd_base . ';charset=utf8mb4', $bd_usuario, $bd_password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        Pdo\Mysql::ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ]);
    $pdo->exec("set names utf8mb4");
    $pdo->exec("SET lc_time_names = 'es_ES';");
    
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
    exit;
}
