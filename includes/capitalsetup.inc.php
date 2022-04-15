<?php

if (isset($_POST["submit"])) {
    
    session_start();
    $citiename = $_POST["citiename"];
    $useruid = $_SESSION["useruid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputCapital($citiename) !== false) {
        header("location: ../cities/index.php?error=emptyinput");
        exit();
    }

    setupCapital($conn, $citiename, $useruid);

}
else {
    header("location: ../user/setup.php?error=notsubmitted");
    exit();
}