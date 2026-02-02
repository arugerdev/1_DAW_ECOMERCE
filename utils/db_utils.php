<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/sessions.php';

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
    case "editUser":
        echo (editUser());
        break;
    case "downloadCSV":
        echo (downloadCSV());
        break;
}

function selectData()
{
    try {

        require $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

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

        require $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

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

        require $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

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

        require $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

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
        require $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

        $username = $_POST["username"];
        $password = $_POST["password"];
        $rememberMe = isset($_POST["remember_me"]);

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
            $userId = $result[0]->id;

            if ($userBD == $username && password_verify($password, $passwordBD)) {
                
               
                require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/sessions.php';
                $tokenCreated = createDatabaseAuthSession($userId);
                
                if (!$tokenCreated && $rememberMe) {
                   
                    error_log("No se pudo crear token en BD, usando sesión PHP");
                }
                
               
                $_SESSION['user'] = $result[0]->username;
                $_SESSION['user_id'] = $userId;
                $_SESSION['state'] = 'authenticated';
                $_SESSION['last_activity'] = time();
                
               
                $updateQuery = $pdo->prepare("
                    UPDATE users 
                    SET last_login = NOW() 
                    WHERE id = :id
                ");
                $updateQuery->bindParam(':id', $userId);
                $updateQuery->execute();

                http_response_code(200);
                return json_encode([
                    "success" => true,
                    "message" => "Login exitoso",
                    "redirect" => "/admin/"
                ]);
            }
        }

       
        sleep(1);
        
        http_response_code(401);
        return json_encode([
            "success" => false,
            "error" => "Los datos de acceso son incorrectos"
        ]);
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        http_response_code(500);
        return json_encode([
            "success" => false,
            "error" => "Error:" . $e->getMessage()
        ]);
    }
}

function editUser()
{
    try {
        require $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

        $id = $_POST["id"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (!$username) {
            return json_encode([
                "success" => false
            ]);
        }

        if (!$password) {
            $password = '';
        }

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

        $query = $pdo->prepare("UPDATE users SET username=:username" . ($password != '' ?  ",password=:password" : "") . " WHERE id = $id");
        $query->bindParam(':username', $username);

        if ($password != '') {
            $encodedPass = crypt($password, "st");
            $query->bindParam(':password', $encodedPass);
        }

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
function createUser()
{
    try {
        require $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

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
   
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/sessions.php';
    logoutDatabaseSession();
    
   
    header("Location: /admin/login");
    exit;
}

function getShopData()
{
    $_REQUEST["select"] = '*';
    $_REQUEST["table"] = 'shop';

    return selectData();
}

function downloadCSV()
{
    try {
        require $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";

        $table = $_REQUEST["table"] ?? "";
        $select = $_REQUEST["select"] ?? "*";
        $extra = $_REQUEST["extra"] ?? "";

        if (!$table) {
            http_response_code(400);
            return json_encode([
                "success" => false,
                "error" => "Tabla no especificada"
            ]);
        }

        $query = $pdo->prepare("SELECT $select FROM $table $extra");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) === 0) {
            http_response_code(404);
            return json_encode([
                "success" => false,
                "error" => "No hay datos para exportar"
            ]);
        }

        $filename = $table . "_" . date('Y-m-d_H-i-s') . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        $headers = array_keys($result[0]);

        fputcsv($output, $headers);

        foreach ($result as $row) {
            $row = array_map(function ($value) {
                if ($value === null) return 'NULL';
                if ($value === true || $value === '1') return 'Sí';
                if ($value === false || $value === '0') return 'No';
                return $value;
            }, $row);

            fputcsv($output, $row);
        }

        fclose($output);
        exit();
    } catch (PDOException $e) {
        http_response_code(500);
        return json_encode([
            "success" => false,
            "error" => $e->getMessage()
        ]);
    }
}
