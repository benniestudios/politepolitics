<?php
session_start();
require_once 'dbh.inc.php';
$userid = $_SESSION['userid'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE usersId='$userid';");


if (!$query) {
    die('Error: ' . mysqli_error($conn));
}

if(mysqli_num_rows($query) > 0){
    while($row = mysqli_fetch_assoc($query)) {
        if($row['usersTaxes' ] >= 80) {
            $sql2 = "UPDATE users SET usersHappiness=20, usersMoneyperhour = usersTaxes * 0.01 * usersPopulation / 5 + usersHappiness + usersMoneyfactor WHERE usersId='$userid'";
        }
        elseif ($row['usersTaxes' ] >= 70) {
            $sql2 = "UPDATE users SET usersHappiness=30, usersMoneyperhour = usersTaxes * 0.01 * usersPopulation / 5 + usersHappiness + usersMoneyfactor WHERE usersId='$userid'";
        }
        elseif ($row['usersTaxes' ] >= 60) {
            $sql2 = "UPDATE users SET usersHappiness=40, usersMoneyperhour = usersTaxes * 0.01 * usersPopulation / 5 + usersHappiness + usersMoneyfactor WHERE usersId='$userid'";
        }
        elseif ($row['usersTaxes' ] >= 50) {
            $sql2 = "UPDATE users SET usersHappiness=50, usersMoneyperhour = usersTaxes * 0.01 * usersPopulation / 5 + usersHappiness + usersMoneyfactor WHERE usersId='$userid'";
        }
        elseif ($row['usersTaxes' ] >= 40) {
            $sql2 = "UPDATE users SET usersHappiness=60, usersMoneyperhour = usersTaxes * 0.01 * usersPopulation / 5 + usersHappiness + usersMoneyfactor WHERE usersId='$userid'";
        }
        elseif ($row['usersTaxes' ] >= 30) {
            $sql2 = "UPDATE users SET usersHappiness=70, usersMoneyperhour = usersTaxes * 0.01 * usersPopulation / 5 + usersHappiness + usersMoneyfactor WHERE usersId='$userid'";
        }
        elseif ($row['usersTaxes' ] > 20) {
            $sql2 = "UPDATE users SET usersHappiness=90, usersMoneyperhour = usersTaxes * 0.01 * usersPopulation / 5 + usersHappiness + usersMoneyfactor WHERE usersId='$userid'";
        }
        elseif ($row['usersTaxes' ] <= 20) {
            $sql2 = "UPDATE users SET usersHappiness=100, usersMoneyperhour = usersTaxes * 0.01 * usersPopulation / 5 + usersHappiness + usersMoneyfactor WHERE usersId='$userid'";
        }
    }
}

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql2)) {
    header("location: ../user/bank.php?error=stmtfailed");
    exit();
}

if (mysqli_query($conn, $sql2)) {
    header('location: ../user/bank.php');
    exit();
}  else {
    header("location: ../user/bank.php?error=notworking");
    exit();
}