<?php

require_once 'dbh.inc.php';

$taxrate = $_POST["changetaxrate"];
$userid = $_POST["userid"];


$sql = "UPDATE users SET usersTaxes='$taxrate' WHERE usersId='$userid'";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../user/bank.php?error=stmtfailed");
    exit();
}

if (mysqli_query($conn, $sql)) {
    header('location: tax2.inc.php');
}  else {
    echo 'not working';
}

