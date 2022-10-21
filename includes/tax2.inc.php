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
        $sql2 = "UPDATE users, buildings SET usersHappiness = ((buildings.buildingsCB+1)*10-buildings.buildingsRB)/(users.usersTaxes/50)  WHERE users.usersUid = buildings.buildingsUser;";
    }
}

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql2)) {
    header("location: ../user/bank.php?error=stmtfailed");
    exit();
}

if (mysqli_query($conn, $sql2)) {
    $query1 = mysqli_query($conn, "SELECT * FROM users, buildings WHERE users.usersUid = buildings.buildingsUser;");

if (!$query1) {
    die('Error: ' . mysqli_error($conn));
}

if(mysqli_num_rows($query1) > 0){
    while($row = mysqli_fetch_assoc($query1)) {

            if ($row['usersHappiness'] < 0) {
                $happysql4 = "UPDATE users, buildings SET usersHappiness = 0 WHERE users.usersUid = buildings.buildingsUser;";
                $stmt= $conn->prepare($happysql4);
                $stmt->execute();
            }

            $happiness = $row['usersHappiness'];
            $alreadydone = 0;


            
            if ($happiness > 100) {
                $username = $row['usersUid'];
                $happysql6 = "UPDATE users, buildings SET usersHappiness = 100 WHERE users.usersUid = '$username';";
                $stmt= $conn->prepare($happysql6);
                $stmt->execute();
            }


        }
    }
    header('location: ../user/bank.php');
    exit();
}  else {
    header("location: ../user/bank.php?error=notworking");
    exit();
}
