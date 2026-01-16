<?php

$adminRoute = get_admin_route();

$routes = [
    '/' => 'dashboard.php',
    '/products' => 'products.php',
    '/orders' => 'orders.php',
];

$view = $routes[$adminRoute] ?? '404.php';

include "template.php";
