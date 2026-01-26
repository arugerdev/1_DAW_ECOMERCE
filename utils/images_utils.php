<?php

declare(strict_types=1);

header('Content-Type: application/json');

define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/uploads');
define('TEMP_PATH', BASE_PATH . '/temp');
define('PRODUCT_PATH', BASE_PATH . '/img/products');
define('ALLOWED_EXT', ['jpg', 'jpeg', 'png', 'webp']);

$action = $_POST['action'] ?? null;
$map = [
    'uploadTempImage'       => 'uploadTempImage',
    'deleteTempImage'       => 'deleteTempImage',
    'deleteAllTempImages'   => 'deleteAllTempImages',
    'finalizeProductImages' => 'finalizeProductImages',
    'moveImagesToTemp'      => 'moveImagesToTemp',
    'getProductImages'      => 'getProductImages',
    'deleteImage'           => 'deleteImage',
    'clearTemp'             => 'clearTemp'
];
if ($action != null) {
    if (!isset($map[$action])) {
        response(false, 'Acción no válida');
    }

    call_user_func($map[$action]);
}

/* ===================== HELPERS ===================== */
function response(bool $success, string $msg = '', array $extra = [])
{
    echo json_encode(array_merge(['success' => $success, 'message' => $msg], $extra));
    exit;
}

function safeToken(string $token): string
{
    return preg_replace('/[^a-zA-Z0-9_-]/', '', $token);
}

function ensureDir(string $dir): void
{
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

function listImages(string $dir): array
{
    if (!is_dir($dir)) return [];
    $files = glob($dir . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
    sort($files, SORT_NATURAL);
    return array_map('basename', $files);
}

/* ===================== ACTIONS ===================== */
function uploadTempImage()
{
    $token = safeToken($_POST['token'] ?? '');
    if (!$token || empty($_FILES['images'])) response(false, 'Token inválido');

    $dir = TEMP_PATH . "/$token";
    ensureDir($dir);

    $uploaded = [];

    foreach ($_FILES['images']['tmp_name'] as $i => $tmp) {
        if (!is_uploaded_file($tmp)) continue;

        $ext = strtolower(pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION));
        if (!in_array($ext, ALLOWED_EXT)) continue;

        $name = uniqid('img_', true) . '.' . $ext;
        move_uploaded_file($tmp, "$dir/$name");
        $uploaded[] = "/uploads/temp/$token/$name";
    }

    response(true, 'OK', ['files' => $uploaded]);
}

function moveImagesToTemp()
{
    $productId = (int)($_POST['product_id'] ?? 0);
    $token = safeToken($_POST['token'] ?? '');

    if ($productId <= 0 || !$token) response(false, 'Datos inválidos');

    $from = PRODUCT_PATH . "/$productId";
    $to   = TEMP_PATH . "/$token";

    if (!is_dir($from)) response(true, 'Sin imágenes', ['files' => []]);

    ensureDir($to);

    $moved = [];
    foreach (listImages($from) as $img) {
        rename("$from/$img", "$to/$img");
        $moved[] = "/uploads/temp/$token/$img";
    }

    response(true, 'OK', ['files' => $moved]);
}

function finalizeProductImages()
{
    $productId = (int)($_POST['product_id'] ?? 0);
    $token = safeToken($_POST['token'] ?? '');

    if ($productId <= 0 || !$token) response(false, 'Datos inválidos');

    $temp  = TEMP_PATH . "/$token";
    $final = PRODUCT_PATH . "/$productId";

    if (!is_dir($temp)) response(true);

    ensureDir($final);

    $images = $_POST['imagesToUpload'] ?? listImages($temp);
    $images = array_map('basename', (array)$images);

    $i = 0;
    foreach ($images as $img) {
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        if (!in_array($ext, ALLOWED_EXT)) continue;
        rename("$temp/$img", "$final/$i.$ext");
        $i++;
    }

    deleteDir($temp);
    response(true);
}

function deleteTempImage()
{
    $token = safeToken($_POST['token'] ?? '');
    $file  = basename($_POST['filename'] ?? '');

    $path = TEMP_PATH . "/$token/$file";
    if (is_file($path)) unlink($path);

    response(true);
}

function deleteAllTempImages()
{
    deleteDir(TEMP_PATH . '/' . safeToken($_POST['token'] ?? ''));
    response(true);
}

function deleteImage()
{
    deleteDir(PRODUCT_PATH . '/' . (int)$_POST['id']);
    response(true);
}

function getProductImages()
{
    $id = (int)$_POST['id'];
    response(true, '', ['images' => listImages(PRODUCT_PATH . "/$id")]);
}

function getProductImagesById($id)
{
    return ['images' => listImages(PRODUCT_PATH . "/$id")];
}

function clearTemp()
{
    foreach (glob(TEMP_PATH . '/*', GLOB_ONLYDIR) as $dir) {
        deleteDir($dir);
    }
    response(true);
}

function deleteDir(string $dir)
{
    if (!is_dir($dir)) return;
    foreach (scandir($dir) as $f) {
        if ($f === '.' || $f === '..') continue;
        $p = "$dir/$f";
        is_dir($p) ? deleteDir($p) : unlink($p);
    }
    rmdir($dir);
}
