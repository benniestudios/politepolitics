<?php

require_once '../dbh.inc.php';

$nation_health_factor = 0.1;

$sql = "UPDATE users, items SET itemsFood=itemsFood-(usersPopulation*$nation_health_factor)";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../user/setup.php?error=stmtfailed");
    exit();
}

if (mysqli_query($conn, $sql)) {
    echo 'worked';
}  else {
    echo 'not working';
}
