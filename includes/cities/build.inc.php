<?php

if (isset($_POST["build"])) {

    session_start();
    $build = $_POST["build"];
    $username = $_SESSION["useruid"];

    require_once '../dbh.inc.php';
    require_once '../functions.inc.php';

    if ($build == "food") {
        buildCapitalFarm($conn, $build, $username);
    } elseif ($build == "coal") {
        buildCapitalCoalmine($conn, $build, $username);
    } elseif ($build == "iron") {
        buildCapitalIronmine($conn, $build, $username);
    } elseif ($build == "commercial") {
        buildCapitalCommercial($conn, $build, $username);
    } elseif ($build == "residential") {
        buildCapitalResidential($conn, $build, $username);
    } elseif ($build == "oil") {
        buildCapitalOil($conn, $build, $username);
    } elseif ($build == "uranium") {
        buildCapitalUranium($conn, $build, $username);
    } elseif ($build == "steel") {
        buildCapitalSteel($conn, $build, $username);
    } else {
        header("location: ../../cities/capital.php?error=nofood");
        exit();
    }
} else {
    header("location: ../../cities/capital.php?error=notworking");
    exit();
}
