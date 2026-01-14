<?php

switch (get_current_url()) {
    case "/":
        include "./templates/main.php";
        break;
    case "/products":
        include "./templates/products.php";
        break;
    case "/admin/products":
        include "./templates/admin/products.php";
        break;
}
