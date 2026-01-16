<?php

$url = get_current_url();

if (is_admin_route()) {
    include "./templates/admin/index.php";
    exit;
}

switch ($url) {
    case "/":
        include "./templates/main.php";
        break;

    case "/products":
        include "./templates/products.php";
        break;

    default:
        http_response_code(404);
        echo "404";
}
