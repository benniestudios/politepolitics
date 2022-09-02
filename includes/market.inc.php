<?php

if (empty($_POST["amount"]) or empty($_POST["price"])) {

    header("location: ../market/create.php?error=somethingwentwrong");
    exit();

} else {

    session_start();
    $resource = $_POST["resource"];
    $amount = $_POST["amount"];
    $price = $_POST["price"];
    $food = $_POST["food"];
    $coal = $_POST["coal"];
    $iron = $_POST["iron"];
    $oil = $_POST["oil"];
    $steel = $_POST["steel"];
    $uranium = $_POST["uranium"];

    $theresource = "$" . $resource;

    $username = $_SESSION["useruid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if ($theresource < $amount) {
        sellResources($conn, $resource, $amount, $price, $username);
    }
    
    
}