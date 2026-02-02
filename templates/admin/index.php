<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/sessions.php';

// Obtener datos del usuario para usar en las vistas
$currentUser = getCurrentUser();

if (!$currentUser) {
    include "views/login.php";
    die();
}
$adminRoute = get_admin_route();

$routes = [
    '/' => 'dashboard.php',
    '/products' => 'products.php',
    '/products/edit' => 'products_edit.php',
    '/orders' => 'orders.php',
    '/users' => 'users.php',
    '/refounds' => 'refounds.php',
    '/categories' => 'categories.php',
    '/customize' => 'customize.php',
    '/config' => 'config.php',
    '/export/products' => '/export/products_csv.php',
    '/preview' => 'preview.php',
];

$view = $routes[$adminRoute] ?? '404.php';

include "template.php";
die();
