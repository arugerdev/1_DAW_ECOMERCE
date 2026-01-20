<?php
session_start();
require_once __DIR__ . '/database.php';

$option = $_REQUEST["action"];

switch ($option) {
    case "login":
        echo (login());
        break;
    case "register":
        echo (register());
        break;
    case "logout":
        echo (logout());
        break;
    case "check":
        echo (checkAuth());
        break;
}

function login()
{
    global $conn;

    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];

    if (empty($email) || empty($password)) {
        return json_encode(["success" => false, "message" => "Email y contraseña requeridos"]);
    }

    $stmt = $conn->prepare("SELECT id, name, last_name, email, password FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return json_encode(["success" => false, "message" => "Credenciales incorrectas"]);
    }

    $customer = $result->fetch_assoc();

    // Verificar contraseña (asumiendo que está hasheada)
    // Si las contraseñas no están hasheadas en tu DB, puedes usar comparación directa temporalmente
    if (password_verify($password, $customer['password']) || $password === $customer['password']) {
        // Guardar en sesión
        $_SESSION["customer"] = [
            "id" => $customer['id'],
            "name" => $customer['name'],
            "last_name" => $customer['last_name'],
            "email" => $customer['email']
        ];

        return json_encode([
            "success" => true,
            "message" => "Login exitoso",
            "customer" => $_SESSION["customer"]
        ]);
    }

    return json_encode(["success" => false, "message" => "Credenciales incorrectas"]);
}

function register()
{
    global $conn;

    $customer = json_decode($_REQUEST["customer"], true);

    if (empty($customer['email']) || empty($customer['password'])) {
        return json_encode(["success" => false, "message" => "Email y contraseña requeridos"]);
    }

    // Verificar si el email ya existe
    $stmt = $conn->prepare("SELECT id FROM customers WHERE email = ?");
    $stmt->bind_param("s", $customer['email']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return json_encode(["success" => false, "message" => "El email ya está registrado"]);
    }

    // Hashear contraseña
    $hashedPassword = password_hash($customer['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO customers (name, last_name, email, phone_number, 
                             address, city, cp, country, password, created_at) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

    $stmt->bind_param(
        "sssssssss",
        $customer['name'],
        $customer['last_name'],
        $customer['email'],
        $customer['phone_number'],
        $customer['address'],
        $customer['city'],
        $customer['cp'],
        $customer['country'],
        $hashedPassword
    );

    if ($stmt->execute()) {
        // Iniciar sesión automáticamente
        $_SESSION["customer"] = [
            "id" => $stmt->insert_id,
            "name" => $customer['name'],
            "last_name" => $customer['last_name'],
            "email" => $customer['email']
        ];

        return json_encode([
            "success" => true,
            "message" => "Registro exitoso",
            "customer" => $_SESSION["customer"]
        ]);
    }

    return json_encode(["success" => false, "message" => "Error en el registro"]);
}

function logout()
{
    unset($_SESSION["customer"]);
    return json_encode(["success" => true, "message" => "Sesión cerrada"]);
}

function checkAuth()
{
    if (isset($_SESSION["customer"])) {
        return json_encode(["authenticated" => true, "customer" => $_SESSION["customer"]]);
    }
    return json_encode(["authenticated" => false]);
}
