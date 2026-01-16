<?php
header('Content-Type: application/json; charset=utf-8');

$productId = intval($_POST['product_id'] ?? 0);
$token = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['token'] ?? '');

if ($productId <= 0 || !$token) {
    http_response_code(400);
    exit;
}

$tempDir =  $_SERVER['DOCUMENT_ROOT'] . "/uploads/temp/$token/";
$finalDir =  $_SERVER['DOCUMENT_ROOT'] . "/uploads/img/products/$productId/";

if (!is_dir($tempDir)) {
    echo json_encode(["success" => true]); // no imágenes
    exit;
}

mkdir($finalDir, 0755, true);

$files = glob($tempDir . "*.{jpg,png,webp}", GLOB_BRACE);
sort($files, SORT_NATURAL);

$i = 0;
foreach ($files as $file) {
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    rename($file, $finalDir . $i . "." . $ext);
    $i++;
}

rmdir($tempDir);

echo json_encode(["success" => true]);
