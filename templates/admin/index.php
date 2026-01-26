<?php

if (isset($_SESSION['user']) && $_SESSION['state'] == 'authenticated') {

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
        '/config' => 'config.php'
    ];

    $view = $routes[$adminRoute] ?? '404.php';
    include "template.php";
    die();
} else {

    include('views/login.php');
    die();
}
