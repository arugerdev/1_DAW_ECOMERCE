<?php

require 'utils/sessions.php';

if (isset($_SESSION['user']) && $_SESSION['state'] == 'authenticated') {

    $adminRoute = get_admin_route(); // Asegúrate de que esta función exista

    $routes = [
        '/' => 'dashboard.php',
        '/products' => 'products.php',
        '/orders' => 'orders.php',
    ];

    $view = $routes[$adminRoute] ?? '404.php';
    include "template.php";
    die();
} else {
    // Si no está autenticado, mostrar login
    include('views/login.php');
    die();
}
