<?php

$token = preg_replace('/[^a-zA-Z0-9-_]/', '', $_POST['token'] ?? '');
if (!$token) exit;

$baseDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/temp/';
$targetDir = $baseDir . $token . '/';

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0775, true);
}

$allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
$uploadeds = [];

foreach ($_FILES['images']['name'] as $i => $name) {
    $tmp  = $_FILES['images']['tmp_name'][$i];
    $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedExt)) continue;
    if (!is_uploaded_file($tmp)) continue;

    $safeName = uniqid('img_', true) . '.' . $ext;
    move_uploaded_file($tmp, $targetDir . $safeName);

    array_push($uploadeds, $targetDir . $safeName);
}

echo json_encode($uploadeds);
