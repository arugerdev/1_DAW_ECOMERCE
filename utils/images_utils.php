<?php

$action = $_REQUEST['action'] ?? '';

switch ($action) {
    case 'deleteImage':
        echo (deleteImage());
        break;
    case 'uploadTempImage':
        echo (uploadTempImage());
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
    case 'clearTemp':
        echo (clearTemp());
        break;
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

        if ($productId <= 0 || !$token) {
            http_response_code(400);
            exit;
        }

        $tempDir =  $_SERVER['DOCUMENT_ROOT'] . "/uploads/temp/$token/";
        $finalDir =  $_SERVER['DOCUMENT_ROOT'] . "/uploads/img/products/$productId/";
        if (!is_dir($tempDir)) {
            echo json_encode(["success" => true]);
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
            deleteDirectory($dir); // Dice que no esta vacio


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
