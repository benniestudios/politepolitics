<?php

if (empty($_POST["amount"]) or empty($_POST[price])) {

    header("location: ../market/create.php?error=somethingwentwrong");
    exit();

} else {

    session_start();
    $resource = $_POST["resource"];
    $amount = $_POST["amount"];
    $price = $_POST["price"];

    $username = $_SESSION["useruid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    sellResources($conn, $resource, $amount, $price, $username);
    
}