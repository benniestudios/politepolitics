<?php

if (isset($_POST["submit"])) {

    session_start();
    $build = $_POST["build"];
    $username = $_SESSION["useruid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    buildCity($conn, $build, $username);

}
else {
    header("location: ../user/setup.php?error=notsubmitted");
    exit();
}
