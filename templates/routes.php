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
    case "/terms":
        include "./templates/views/terms.php";
        break;
    case "/privacy":
        include "./templates/views/privacy.php";
        break;

    case "/products":
        include "./templates/views/products.php";
        break;
    case "/products/category":
        include "./templates/views/products_category.php";
        break;
    case "/product":
        include "./templates/views/product.php";
        break;
    case "/cart":
        include "./templates/views/cart.php";
        break;
    case "/orders":
        include "./templates/views/orders.php";
        break;
    case "/login":
        include "./templates/views/login.php";
        break;
    case "/register":
        include "./templates/views/register.php";
        break;
    case "/checkout":
        include "./templates/views/checkout.php";
        break;
    case "/checkout/confirm":
        include "./templates/views/checkout_confirm.php";
        break;
    case "/checkout/success":
        include "./templates/views/checkout_success.php";
        break;
    default:
        http_response_code(404);
        include "./templates/views/404.php";
        break;
}
