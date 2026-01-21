<?php
session_start();

$option = $_REQUEST["action"];

switch ($option) {
    case "select":
        echo (selectData());
        break;
    case "delete":
        echo (deleteData());
        break;
    case "update":
        echo (updateData());
        break;
    case "insert":
        echo (insertData());
        break;
    case "loginAdmin":
        echo (loginAdmin());
        break;
    case "clearSession":
        echo (clearSession());
        break;
    case "createUser":
        echo (createUser());
        break;
}

function selectData()
{
    try {

        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

        $select = $_REQUEST["select"] ?? "";
        $table = $_REQUEST["table"] ?? "";
        $extra = $_REQUEST["extra"] ?? "";

        $query = $pdo->prepare("SELECT $select FROM $table $extra");
        $query->execute();
        $result = $query->fetchAll();

        http_response_code(200);
        return json_encode([
            "success" => true,
            "data" => $result
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        return json_encode([
            "success" => false,
            "error" => $e->getMessage()
        ]);
        exit;
    }
}

function deleteData()
{
    try {

        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

        $table = $_REQUEST["table"];
        $filterParam = $_REQUEST["filterParam"];
        $filterValue = $_REQUEST["filterValue"];
        $extra = $_REQUEST["extra"];

        $query = $pdo->prepare("DELETE FROM $table WHERE $filterParam = '$filterValue' $extra");
        $query->execute();
        $result = $query->fetchAll();


        http_response_code(200);
        return json_encode([
            "success" => true,
            "data" => $result
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        return json_encode([
            "success" => false,
            "error" => $e->getMessage()
        ]);
        exit;
    }
}

function insertData()
{
    try {

        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

        $table = $_REQUEST["table"];
        $keys = $_REQUEST["keys"];
        $values = $_REQUEST["values"];
        $extra = $_REQUEST["extra"];

        $query = $pdo->prepare("INSERT INTO $table ($keys) VALUES ($values) $extra ");

        $query->execute();
        $result = $query->fetchAll();

        $newId = $pdo->lastInsertId();

        http_response_code(200);
        return json_encode([
            "success" => true,
            "data" => $result,
            "newId" => $newId
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        return json_encode([
            "success" => false,
            "error" => $e->getMessage()
        ]);
        exit;
    }
}

function updateData()
{
    try {

        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

        $table = $_REQUEST["table"];
        $values = $_REQUEST["values"];
        $extra = $_REQUEST["extra"];

        $query = $pdo->prepare("UPDATE $table SET $values $extra ");

        $query->execute();
        $result = $query->fetchAll();


        http_response_code(200);
        return json_encode([
            "success" => true,
            "data" => $result
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        return json_encode([
            "success" => false,
            "error" => $e->getMessage()
        ]);
        exit;
    }
}

function loginAdmin()
{
    try {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

        $username = $_POST["username"];
        $password = $_POST["password"];

        $maxCharactersUsername = "20";
        $maxCharactersPassword = "60";

        if (strlen($username) > $maxCharactersUsername) {
            return json_encode([
                "success" => false,
                "error" => 'El nombre de usuario no puede superar los ' . $maxCharactersUsername . ' caracteres'
            ]);
        };

        if (strlen($password) > $maxCharactersPassword) {
            return json_encode([
                "success" => false,
                "error" => 'La contraseña no puede superar los ' . $maxCharactersPassword . ' caracteres'
            ]);
        };

        $query = $pdo->prepare("SELECT * FROM `users` WHERE username = :username");
        $query->bindParam(':username', $username);
        $query->execute();

        $result = $query->fetchAll();

        if (count($result) > 0) {
            $userBD = $result[0]->username;
            $passwordBD = $result[0]->password;

            if ($userBD == $username && password_verify($password, $passwordBD)) {

                $_SESSION['user'] = $result[0]->username;
                $_SESSION['state'] = 'authenticated';
                $_SESSION['last_activity'] = time();

                http_response_code(200);
                return json_encode([
                    "success" => true,
                    "message" => "Login exitoso",
                    "redirect" => "/admin/"
                ]);
            }
        }

        http_response_code(401);
        return json_encode([
            "success" => false,
            "error" => "Los datos de acceso son incorrectos"
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        return json_encode([
            "success" => false,
            "error" => $e->getMessage()
        ]);
    }
}

function createUser()
{
    try {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

        $username = $_POST["username"];
        $password = $_POST["password"];

        $maxCharactersUsername = "20";
        $maxCharactersPassword = "60";

        if (strlen($username) > $maxCharactersUsername) {
            return json_encode([
                "success" => false,
                "error" => 'El nombre de usuario no puede superar los ' . $maxCharactersUsername . ' caracteres'
            ]);
        };

        if (strlen($password) > $maxCharactersPassword) {
            return json_encode([
                "success" => false,
                "error" => 'La contraseña no puede superar los ' . $maxCharactersPassword . ' caracteres'
            ]);
        };

        $query = $pdo->prepare("INSERT INTO `users` (username, password) VALUES (:username, :password)");
        $query->bindParam(':username', $username);

        $encodedPass = crypt($password, "st");

        $query->bindParam(':password', $encodedPass);

        $query->execute();

        http_response_code(200);
        return json_encode([
            "success" => true
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        return json_encode([
            "success" => false,
            "error" => $e->getMessage()
        ]);
    }
}

function clearSession()
{

    session_start();

    unset($_SESSION);

    session_destroy();

    header("Location: /admin/");

    return json_encode([
        "success" => true
    ]);
}
