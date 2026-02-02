<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/sessions.php';

$option = $_REQUEST["action"];

switch ($option) {
    case "add":
        echo (addToCart());
        break;
    case "delete":
        echo (deleteFromCart());
        break;
    case "select":
        echo (selectCart());
        break;
    case "update_quantity":
        echo (updateQuantity());
        break;
    case "clear":
        echo (clearCart());
        break;
    case "get_cart_total":
        echo (getCartTotal());
        break;
}

function addToCart()
{
    if (!isset($_SESSION["cart_products"]) || gettype($_SESSION["cart_products"]) != "array") {
        $_SESSION["cart_products"] = [];
    }

    $item = $_REQUEST["item"];

    $_SESSION["cart_products"][] = $item;

    return json_encode([
        "success" => true,
        "count" => count($_SESSION["cart_products"])
    ]);
}

function deleteFromCart()
{
    if (!isset($_SESSION["cart_products"])) {
        return json_encode(["success" => false, "message" => "Carrito no encontrado"]);
    }

    $productId = $_REQUEST["product_id"];
    $newCart = array_filter($_SESSION["cart_products"], function ($product) use ($productId) {
        return $product['id'] != $productId;
    });

    $_SESSION["cart_products"] = array_values($newCart);

    return json_encode([
        "success" => true,
        "count" => count($_SESSION["cart_products"])
    ]);
}

function updateQuantity()
{
    if (!isset($_SESSION["cart_products"])) {
        return json_encode(["success" => false, "message" => "Carrito no encontrado"]);
    }

    $productId = $_REQUEST["product_id"];
    $newQuantity = intval($_REQUEST["quantity"]);
    $product = null;
    foreach ($_SESSION["cart_products"] as $item) {
        if ($item['id'] == $productId) {
            $product = $item;
            break;
        }
    }

    if (!$product) {
        return json_encode(["success" => false, "message" => "Producto no encontrado"]);
    }
    $unitPrice = floatval($product['w_tax_price']);
    if (isset($product['on_sale']) && $product['on_sale'] == '1' && isset($product['sale_discound'])) {
        $discount = floatval($product['sale_discound']);
        $unitPrice = $unitPrice * (1 - $discount / 100);
    }
    $currentItems = array_filter($_SESSION["cart_products"], function ($item) use ($productId) {
        return $item['id'] == $productId;
    });
    $newCart = array_filter($_SESSION["cart_products"], function ($item) use ($productId) {
        return $item['id'] != $productId;
    });
    for ($i = 0; $i < $newQuantity; $i++) {
        $newCart[] = $product;
    }

    $_SESSION["cart_products"] = array_values($newCart);

    return json_encode([
        "success" => true,
        "unit_price" => $unitPrice,
        "count" => count($_SESSION["cart_products"])
    ]);
}

function clearCart()
{
    $_SESSION["cart_products"] = [];
    return json_encode([
        "success" => true
    ]);
}

function selectCart()
{
    if (!isset($_SESSION["cart_products"])) {
        return json_encode(["cart" => []]);
    }

    return json_encode([
        "cart" => $_SESSION["cart_products"],
        "count" => count($_SESSION["cart_products"])
    ]);
}

function getCartTotal()
{
    if (!isset($_SESSION["cart_products"]) || empty($_SESSION["cart_products"])) {
        return json_encode(["total" => 0]);
    }

    $total = 0;
    $groupedProducts = [];

    foreach ($_SESSION["cart_products"] as $product) {
        $id = $product['id'];
        if (!isset($groupedProducts[$id])) {
            $groupedProducts[$id] = [
                'price' => floatval($product['w_tax_price']),
                'discount' => 0
            ];

            if (isset($product['on_sale']) && $product['on_sale'] == '1' && isset($product['sale_discound'])) {
                $groupedProducts[$id]['discount'] = floatval($product['sale_discound']);
            }
        }
    }

    foreach ($groupedProducts as $id => $productData) {
        $count = 0;
        foreach ($_SESSION["cart_products"] as $product) {
            if ($product['id'] == $id) {
                $count++;
            }
        }

        $price = $productData['price'];
        if ($productData['discount'] > 0) {
            $price = $price * (1 - $productData['discount'] / 100);
        }

        $total += $price * $count;
    }

    return json_encode(["total" => $total]);
}
