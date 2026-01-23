<?php

$action = $_REQUEST['action'] ?? '';

switch ($action) {
    case 'deleteImage':
        echo (deleteImage());
        break;
    case 'uploadTempImage':
        echo (uploadTempImage());
        break;
    case 'getProductImages':
        echo (getProductImages());
        break;
    case 'deleteTempImage':
        echo (deleteTempImage());
        break;
    case 'deleteAllTempImages':
        echo (deleteAllTempImages());
        break;
    case 'finalizeProductImages':
        echo (finalizeProductImages());
        break;
    case 'moveImagesToTemp':
        echo (moveImagesToTemp());
        break;
    case 'clearTemp':
        echo (clearTemp());
        break;
}

function moveImagesToTemp()
{
    try {
        $productId = intval($_POST['product_id'] ?? 0);
        $token = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['token'] ?? '');
        if ($productId <= 0 || !$token) {
            http_response_code(400);
            exit;
        }
        $sourceDir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/img/products/$productId/";
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/temp/$token/";
        if (!is_dir($sourceDir)) {
            echo json_encode(['success' => true, 'files' => []]);
            exit;
        }
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        $files = glob($sourceDir . "*.{jpg,png,webp}", GLOB_BRACE);
        sort($files, SORT_NATURAL);
        $movedFiles = [];
        foreach ($files as $file) {
            $filename = basename($file);
            rename($file, $targetDir . $filename);
            $movedFiles[] = $targetDir . $filename;
        }
        echo json_encode(['success' => true, 'files' => $movedFiles]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

function deleteImage()
{
    $id = intval($_POST['id'] ?? 0);
    $dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/img/products/$id/";
    if (!is_dir($dir)) {
        echo json_encode(['success' => true, 'message' => 'Directorio no existe']);
        exit;
    }

    // Eliminar la carpeta con todos los archivos al completo
    try {
        $files = glob($dir . '*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        rmdir($dir);

        echo json_encode(['success' => true, 'message' => 'Imágenes eliminadas']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

function getProductImages()
{

    $id = intval($_POST['id'] ?? 0);
    $dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/img/products/$id/";
    $images = [];

    if (!is_dir($dir)) {
        echo json_encode(['success' => true, 'images' => $images]);
        exit;
    }

    try {
        $files = glob($dir . "*.{jpg,png,webp}", GLOB_BRACE);
        sort($files, SORT_NATURAL);

        foreach ($files as $file) {
            $images[] = basename($file);
        }

        echo json_encode(['success' => true, 'images' => $images]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

function getProductMainImage($productId)
{
    $dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/img/products/$productId";

    if (!is_dir($dir)) {
        return null;
    }

    $files = array_values(array_filter(scandir($dir), function ($file) {
        return preg_match('/\.(png|jpg|jpeg|webp)$/i', $file);
    }));

    if (empty($files)) {
        return null;
    }

    sort($files);

    return "/uploads/img/products/$productId/" . $files[0];
}

function uploadTempImage()
{
    try {
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
        echo json_encode(['success' => true, 'message' => 'Temporary image uploaded', 'files' => $uploadeds]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

function deleteTempImage()
{
    $token = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['token'] ?? '');
    $filename = $_POST['filename'] ?? '';

    if (!$token || !$filename) {
        echo json_encode(['success' => false, 'message' => 'Token o nombre de archivo inválido']);
        exit;
    }

    $filePath = $_SERVER['DOCUMENT_ROOT'] . "/uploads/temp/$token/$filename";

    try {
        if (file_exists($filePath) && is_file($filePath)) {
            unlink($filePath);
            echo json_encode(['success' => true, 'message' => 'Imagen temporal eliminada']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Archivo no encontrado']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

function deleteAllTempImages()
{
    $token = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['token'] ?? '');

    if (!$token) {
        echo json_encode(['success' => false, 'message' => 'Token inválido']);
        exit;
    }

    $tempDir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/temp/$token/";

    if (!is_dir($tempDir)) {
        echo json_encode(['success' => true, 'message' => 'Directorio no existe']);
        exit;
    }

    try {
        $files = glob($tempDir . '*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        if (count(glob($tempDir . '*')) === 0) {
            rmdir($tempDir);
        }

        echo json_encode(['success' => true, 'message' => 'Todas las imágenes temporales eliminadas']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

function finalizeProductImages()
{
    try {
        $productId = intval($_POST['product_id'] ?? 0);
        $token = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['token'] ?? '');

        $tempDir  = $_SERVER['DOCUMENT_ROOT'] . "/uploads/temp/$token/";
        $finalDir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/img/products/$productId/";

        $imagesToUpload = $_POST['imagesToUpload'] ??  glob($tempDir . '*');

        if ($productId <= 0 || !$token) {
            http_response_code(400);
            exit;
        }

        if (!is_dir($tempDir)) {
            echo json_encode(['success' => true]);
            exit;
        }

        if (!is_dir($finalDir)) {
            mkdir($finalDir, 0755, true);
        }

        // Normalizar array
        if (!is_array($imagesToUpload)) {
            $imagesToUpload = [];
        }

        $imagesToUpload = array_map(function ($img) {
            return basename($img); // seguridad
        }, $imagesToUpload);

        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
        $index = 0;

        // Mover SOLO las imágenes seleccionadas
        foreach ($imagesToUpload as $image) {
            $source = $tempDir . $image;

            if (!file_exists($source)) continue;

            $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
            if (!in_array($ext, $allowedExt)) continue;

            rename($source, $finalDir . $index . '.' . $ext);
            $index++;
        }

        // Eliminar las imágenes no usadas
        $remaining = glob($tempDir . '*');
        foreach ($remaining as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        rmdir($tempDir);

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

function clearTemp()
{
    $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/temp/';

    if (!is_dir($baseDir)) {
        echo json_encode(['success' => true, 'message' => 'Directorio no existe']);
        exit;
    }

    try {
        $dirs = glob($baseDir . '*', GLOB_ONLYDIR);
        foreach ($dirs as $dir) {
            $files = glob($dir . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            deleteDirectory($dir);
        }

        echo json_encode(['success' => true, 'message' => 'Directorio temporal limpiado']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
function deleteDirectory($dir)
{
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }

    return rmdir($dir);
}
