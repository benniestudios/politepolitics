<?php

require_once 'dbh.inc.php';

$taxrate = $_POST["changetaxrate"];
$userid = $_POST["userid"];


$sql = "UPDATE users SET usersTaxes=? WHERE usersId=?;";
$stmt= $conn->prepare($sql);
$stmt->bind_param("ss", $taxrate, $userid);
$stmt->execute();
header("Location: tax2.inc.php?taxset=success");

