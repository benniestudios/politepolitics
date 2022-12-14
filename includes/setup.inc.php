<?php

if (isset($_POST["submit"])) {

    session_start();
    $nationname = $_POST["nationname"];
    $nationtype = $_POST["nationtype"];
    $color = $_POST["color"];
    $flag = $_POST["flag"];
    $userid = $_SESSION["userid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSetup($nationname, $nationtype) !== false) {
        header("location: ../user/setup.php?error=emptyinput");
        exit();
    }

    setupUser($conn, $nationname, $nationtype, $userid, $color, $flag);

}
else {
    header("location: ../user/setup.php?error=notsubmitted");
    exit();
}
