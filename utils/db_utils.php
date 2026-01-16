<?php

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
