<?php

require_once 'dbh.inc.php';

$taxrate = $_POST["changetaxrate"];
$userid = $_POST["userid"];


$sql = "UPDATE users SET usersTaxes=? WHERE usersId=?;";
$stmt= $conn->prepare($sql);
$stmt->bind_param("ss", $taxrate, $userid);
$stmt->execute();

$sqlMoneyperhour = "UPDATE users, buildings SET usersMoneyfactor=buildingsCB*50, usersMoneyperhour = usersTaxes * 0.01 * usersPopulation / 5 + usersHappiness + usersMoneyfactor WHERE buildings.buildingsUser = users.usersUid";
$stmt = mysqli_stmt_init($conn);
if (mysqli_query($conn, $sqlMoneyperhour)) {
    echo 'worked';
    header("Location: tax2.inc.php?taxset=success");
}  else {
    echo 'not working';
}


