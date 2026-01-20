<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

$option = $_REQUEST["action"];

switch ($option) {
    case "save_customer_info":
        echo (saveCustomerInfo());
        break;
    case "get_customer_info":
        echo (getCustomerInfo());
        break;
    case "create_order":
        echo (createOrder());
        break;
}

function saveCustomerInfo()
{
    if (!isset($_REQUEST["customer"])) {
        return json_encode(["success" => false, "message" => "Datos del cliente no recibidos"]);
    }

    $customer = json_decode($_REQUEST["customer"], true);

    // Validar campos requeridos
    $requiredFields = ['name', 'email', 'phone_number', 'address', 'city', 'cp', 'country'];
    foreach ($requiredFields as $field) {
        if (empty($customer[$field])) {
            return json_encode(["success" => false, "message" => "El campo $field es requerido"]);
        }
    }

    $_SESSION["checkout_customer"] = $customer;

    return json_encode([
        "success" => true,
        "message" => "Información guardada correctamente"
    ]);
}

function getCustomerInfo()
{
    if (!isset($_SESSION["checkout_customer"])) {
        return json_encode(["success" => false, "message" => "No hay información del cliente"]);
    }

    return json_encode([
        "success" => true,
        "customer" => $_SESSION["checkout_customer"]
    ]);
}

function createOrder()
{
    global $pdo;

    if (!isset($_SESSION["checkout_customer"])) {
        return json_encode(["success" => false, "message" => "Información del cliente no encontrada"]);
    }

    if (!isset($_SESSION["cart_products"]) || empty($_SESSION["cart_products"])) {
        return json_encode(["success" => false, "message" => "El carrito está vacío"]);
    }

    $customer = $_SESSION["checkout_customer"];
    $shippingMethod = $_REQUEST["shipping_method"] ?? "standard";
    $paymentMethod = $_REQUEST["payment_method"] ?? "card";

    $subtotal = 0;
    $groupedProducts = [];

    foreach ($_SESSION["cart_products"] as $product) {
        $id = $product['id'];
        if (!isset($groupedProducts[$id])) {
            $groupedProducts[$id] = [
                'product' => $product,
                'quantity' => 0,
                'price' => floatval($product['price'])
            ];

            if (isset($product['on_sale']) && $product['on_sale'] == '1' && isset($product['sale_discound'])) {
                $discount = floatval($product['sale_discound']);
                $groupedProducts[$id]['price'] = $groupedProducts[$id]['price'] * (1 - $discount / 100);
            }
        }
        $groupedProducts[$id]['quantity']++;
    }

    foreach ($groupedProducts as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    $shippingCost = $shippingMethod === "express" ? 10.00 : 5.00;
    $total = $subtotal + $shippingCost;

    try {
        $pdo->beginTransaction();

        // Crear o obtener cliente
        $customerId = createOrGetCustomer($customer, $pdo);

        if ($customerId === 0) {
            throw new Exception("Error al crear o obtener el cliente");
        }

        $orderNumber = generateOrderNumber();
        $status = "pending";

        // Insertar pedido
        $stmt = $pdo->prepare("INSERT INTO orders (order_number, customer_id, total_amount, status) 
                               VALUES (:order_number, :customer_id, :total_amount, :status)");

        $stmt->execute([
            ':order_number' => $orderNumber,
            ':customer_id' => $customerId,
            ':total_amount' => $total,
            ':status' => $status
        ]);

        $orderId = $pdo->lastInsertId();

        // Insertar productos del pedido
        foreach ($groupedProducts as $item) {
            $product = $item['product'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $totalItem = $price * $quantity;

            $stmt = $pdo->prepare("INSERT INTO prodToOrder (orderId, productId, quantity, unit_price, total_price) 
                                   VALUES (:orderId, :productId, :quantity, :unit_price, :total_price)");

            $stmt->execute([
                ':orderId' => $orderId,
                ':productId' => $product['id'],
                ':quantity' => $quantity,
                ':unit_price' => $price,
                ':total_price' => $totalItem
            ]);

            // Actualizar stock del producto
            $updateStmt = $pdo->prepare("UPDATE products SET stock = stock - :quantity WHERE id = :product_id");
            $updateStmt->execute([
                ':quantity' => $quantity,
                ':product_id' => $product['id']
            ]);
        }

        $pdo->commit();

        // Limpiar sesiones
        unset($_SESSION["cart_products"]);
        unset($_SESSION["checkout_customer"]);

        return json_encode([
            "success" => true,
            "order_id" => $orderId,
            "order_number" => $orderNumber,
            "total" => $total,
            "message" => "Pedido creado correctamente"
        ]);
    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollback();
        }

        return json_encode([
            "success" => false,
            "message" => "Error al crear el pedido: " . $e->getMessage()
        ]);
    }
}

function createOrGetCustomer($customerData, $pdo)
{
    try {
        // Verificar si el cliente ya existe
        $stmt = $pdo->prepare("SELECT id FROM customers WHERE email = :email");
        $stmt->execute([':email' => $customerData['email']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['id'];
        }

        // Crear nuevo cliente
        $stmt = $pdo->prepare("INSERT INTO customers (name, last_name, email, phone_number, 
                                 address, city, cp, country, create_at) 
                               VALUES (:name, :last_name, :email, :phone_number, :address, 
                                       :city, :cp, :country, NOW())");

        $stmt->execute([
            ':name' => $customerData['name'],
            ':last_name' => $customerData['last_name'] ?? '',
            ':email' => $customerData['email'],
            ':phone_number' => $customerData['phone_number'],
            ':address' => $customerData['address'],
            ':city' => $customerData['city'],
            ':cp' => $customerData['cp'],
            ':country' => $customerData['country']
        ]);

        return $pdo->lastInsertId();
    } catch (Exception $e) {
        error_log("Error en createOrGetCustomer: " . $e->getMessage());
        return 0;
    }
}

function generateOrderNumber()
{
    return 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
}
