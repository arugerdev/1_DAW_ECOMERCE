<?php

$url = get_current_url();

if (is_admin_route()) {
    include "./templates/admin/index.php";
    exit;
}

switch ($url) {
    case "/":
        include "./templates/index.php";
        break;

    case "/products":
        include "./templates/views/products.php";
        break;

    case "/product":
        include "./templates/views/product.php";
        break;

    case "/cart":
        include "./templates/views/cart.php";
        break;

    default:
        http_response_code(404);
        include "./templates/views/404.php";
        break;
}
