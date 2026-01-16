<?php

$option = $_REQUEST["action"];

switch ($option) {
    case "select":
        echo json_encode(selectData());
        break;
    case "delete":
        echo json_encode(deleteData());
        break;
    case "insert":
        echo json_encode(insertData());
        break;
}

function selectData()
{
    require "../includes/database.php";

    $select = $_REQUEST["select"] ?? "";
    $table = $_REQUEST["table"] ?? "";
    $extra = $_REQUEST["extra"] ?? "";

    $query = $pdo->prepare("SELECT $select FROM $table $extra");
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

function deleteData()
{
    require "../includes/database.php";

    $select = $_REQUEST["select"];
    $table = $_REQUEST["table"];
    $extra = $_REQUEST["extra"];

    $query = $pdo->prepare("DELETE FROM $table WHERE $filterParam = '$filterValue' $extra");
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

function insertData()
{
    require "../includes/database.php";

    $table = $_REQUEST["table"];
    $keys = $_REQUEST["keys"];
    $values = $_REQUEST["values"];
    $extra = $_REQUEST["extra"];

    $query = $pdo->prepare("INSERT INTO $table ($keys) VALUES ($values) $extra");

    $query->execute();
    $result = $query->fetchAll();

    return $result;
}
