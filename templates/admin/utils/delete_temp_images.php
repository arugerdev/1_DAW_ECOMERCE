<?php
header('Content-Type: application/json; charset=utf-8');

$token = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['token'] ?? '');
$action = $_POST['action'] ?? '';
$filename = $_POST['filename'] ?? '';

if (!$token) {
    echo json_encode(['success' => false, 'message' => 'Token inválido']);
    exit;
}

$tempDir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/temp/$token/";

// Verificar que el directorio existe
if (!is_dir($tempDir)) {
    echo json_encode(['success' => true, 'message' => 'Directorio no existe']);
    exit;
}

try {
    if ($action === 'delete_all') {
        // Borrar todos los archivos del directorio temporal
        $files = glob($tempDir . '*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        // Intentar eliminar el directorio
        if (count(glob($tempDir . '*')) === 0) {
            rmdir($tempDir);
        }

        echo json_encode(['success' => true, 'message' => 'Todas las imágenes eliminadas']);
    } elseif ($action === 'delete_single' && $filename) {
        // Borrar una imagen específica
        $filePath = $tempDir . $filename;

        if (file_exists($filePath) && is_file($filePath)) {
            unlink($filePath);

            // Verificar si el directorio está vacío y eliminarlo si es así
            $remainingFiles = glob($tempDir . '*');
            if (count($remainingFiles) === 0) {
                rmdir($tempDir);
            }

            echo json_encode(['success' => true, 'message' => 'Imagen eliminada']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Archivo no encontrado']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
