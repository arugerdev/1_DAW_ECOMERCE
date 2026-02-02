<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/sessions.php';

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'create_order':
        echo createOrder($pdo);
        break;
    case 'get_customer_info':
        echo getCustomerInfo($pdo);
        break;
}

function getCustomerInfo($pdo)
{
    try {
        if (isset($_SESSION['customer'])) {

            // Return the customer info stored in db because need all of them

            $query = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
            $query->execute([$_SESSION['customer']['id']]);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            // Evitar informacion sesnible como password
            unset($data['password']);

            return json_encode([
                "success" => true,
                "customer" => $data
            ]);
        } else {
            return json_encode(["success" => false]);
        }
    } catch (Exception $e) {
        return json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}

function createOrder($pdo)
{
    if (!isset($_SESSION['customer'], $_SESSION['cart_products'])) {
        return json_encode(["success" => false]);
    }

    $customer = $_SESSION['customer'];
    $products = $_SESSION['cart_products'];
    $shipping = $_POST['shipping_method'];
    $payment = $_POST['payment_method'];

    // Agrupar productos por ID
    $groupedProducts = [];
    $subtotal = 0;

    foreach ($products as $p) {
        $productId = $p['id'];

        if (!isset($groupedProducts[$productId])) {
            $groupedProducts[$productId] = [
                'id' => $p['id'],
                'price' => $p['price'],
                'quantity' => 0,
                'total_price' => 0
            ];
        }

        $groupedProducts[$productId]['quantity']++;
        $groupedProducts[$productId]['total_price'] += $p['price'];
        $subtotal += $p['price'];
    }

    $total = $subtotal + 5;

    $pdo->beginTransaction();

    try {
        $stmt = $pdo->prepare("
            INSERT INTO orders (order_number, customer_id, total_amount, shipping_method, payment_method)
            VALUES (?, ?, ?, ?, ?)
        ");
        $orderNumber = 'ORD-' . strtoupper(uniqid());
        $stmt->execute([
            $orderNumber,
            $_SESSION['customer']['id'],
            $total,
            $shipping,
            $payment
        ]);

        $orderId = $pdo->lastInsertId();

        // Insertar productos agrupados
        foreach ($groupedProducts as $product) {
            $stmt = $pdo->prepare("
                INSERT INTO prodToOrder (orderId, productId, quantity, unit_price, total_price)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $orderId,
                $product['id'],
                $product['quantity'],  // ← Cantidad correcta
                $product['price'],
                $product['total_price']
            ]);

            $stmt = $pdo->prepare("
                UPDATE products SET stock = stock - ? WHERE id = ?
            ");
            $stmt->execute([$product['quantity'], $product['id']]);
        }

        $pdo->commit();
        unset($_SESSION['cart_products'], $_SESSION['customer']);

        return json_encode(["success" => true, "orderNumber" => $orderNumber]);
    } catch (Exception $e) {
        $pdo->rollBack();
        return json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}
