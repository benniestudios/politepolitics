<?php

require_once 'dbh.inc.php';

date_default_timezone_set('UTC');
$time = date('H:i:s');
$setdaily = 1;
$sql = "UPDATE users SET usersTime=?, usersDaily=?";
$stmt= $conn->prepare($sql);
$stmt->bind_param("si", $time, $setdaily);
$stmt->execute();