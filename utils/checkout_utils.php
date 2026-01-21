<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'save_customer_info':
        echo saveCustomerInfo();
        break;
    case 'create_order':
        echo createOrder($pdo);
        break;
    case 'get_customer_info':
        echo getCustomerInfo($pdo);
        break;
}

function saveCustomerInfo()
{
    $_SESSION['customer'] = json_decode($_POST['customer'], true);
    return json_encode(["success" => true]);
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

    $subtotal = 0;
    foreach ($products as $p) {
        $subtotal += $p['price'];
    }

    $total = $subtotal + 5;

    $pdo->beginTransaction();

    try {
        $stmt = $pdo->prepare("
            INSERT INTO orders (order_number, customer_id, total_amount)
            VALUES (?, ?, ?)
        ");
        $orderNumber = 'ORD-' . strtoupper(uniqid());
        $stmt->execute([
            $orderNumber,
            $_SESSION['customer']['id'] ?? createGuest($pdo, $customer),
            $total
        ]);

        $orderId = $pdo->lastInsertId();

        foreach ($products as $p) {
            $stmt = $pdo->prepare("
                INSERT INTO prodToOrder (orderId, productId, quantity, unit_price, total_price)
                VALUES (?, ?, 1, ?, ?)
            ");
            $stmt->execute([$orderId, $p['id'], $p['price'], $p['price']]);
        }

        $pdo->commit();
        unset($_SESSION['cart_products'], $_SESSION['customer']);

        return json_encode(["success" => true, "orderNumber" => $orderNumber]);
    } catch (Exception $e) {
        $pdo->rollBack();
        return json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}

function createGuest($pdo, $c)
{
    $stmt = $pdo->prepare("
        INSERT INTO customers (name,email,phone_number,address,city,cp,country)
        VALUES (?,?,?,?,?,?,?)
    ");
    $stmt->execute([
        $c['name'],
        $c['email'],
        $c['phone_number'],
        $c['address'],
        $c['city'],
        $c['cp'],
        $c['country']
    ]);

    return $pdo->lastInsertId();
}
