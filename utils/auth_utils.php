<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'login':
        echo login($pdo);
        break;
    case 'register':
        echo register($pdo);
        break;
    case 'logout':
        echo logout();
        break;
    case 'check':
        echo checkAuth();
        break;
}

function login($pdo)
{
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        return json_encode(["success" => false, "message" => "Datos incompletos"]);
    }

    $stmt = $pdo->prepare("SELECT * FROM customers WHERE email = ?");
    $stmt->execute([$email]);
    $customer = $stmt->fetch();
    

    if (!$customer || !password_verify($password, $customer->password)) {
        return json_encode(["success" => false, "message" => "Credenciales incorrectas"]);
    }

    $_SESSION['customer'] = [
        "id" => $customer->id,
        "name" => $customer->name,
        "last_name" => $customer->last_name,
        "email" => $customer->email
    ];

    return json_encode(["success" => true]);
}

function register($pdo)
{
    $customer = json_decode($_POST['customer'], true);

    $required = ['name', 'email', 'password', 'phone_number', 'address', 'city', 'cp', 'country'];
    foreach ($required as $f) {
        if (empty($customer[$f])) {
            return json_encode(["success" => false, "message" => "Campo $f requerido"]);
        }
    }

    $stmt = $pdo->prepare("SELECT id FROM customers WHERE email = ?");
    $stmt->execute([$customer['email']]);
    if ($stmt->fetch()) {
        return json_encode(["success" => false, "message" => "Email ya registrado"]);
    }

    $hash = password_hash($customer['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO customers 
        (name,last_name,email,phone_number,address,city,cp,country,password)
        VALUES (?,?,?,?,?,?,?,?,?)
    ");

    $stmt->execute([
        $customer['name'],
        $customer['last_name'] ?? '',
        $customer['email'],
        $customer['phone_number'],
        $customer['address'],
        $customer['city'],
        $customer['cp'],
        $customer['country'],
        $hash
    ]);

    $_SESSION['customer'] = [
        "id" => $pdo->lastInsertId(),
        "name" => $customer['name'],
        "last_name" => $customer['last_name'],
        "email" => $customer['email']
    ];

    return json_encode(["success" => true]);
}

function logout()
{
    unset($_SESSION['customer']);
    return json_encode(["success" => true]);
}

function checkAuth()
{
    return json_encode([
        "authenticated" => isset($_SESSION['customer']),
        "customer" => $_SESSION['customer'] ?? null
    ]);
}
