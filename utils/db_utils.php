<?php

$option = $_REQUEST["action"];

switch ($option) {
    case "select":
        selectData();
        break;
    case "delete":
        deleteData();
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

    echo json_encode($result);
}

function deleteData()
{
    require "../includes/database.php";

    $select = $_POST["select"];
    $table = $_POST["table"];
    $extra = $_POST["extra"];

    $query = $pdo->prepare("DELETE FROM $table WHERE $filterParam = '$filterValue' $extra");
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}
