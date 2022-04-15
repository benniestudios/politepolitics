<?php

$serverName = "localhost";
$dBUsername = "u98542p92708_ppbs";
$dBPassword = "5TK3jghym9eGzWqY";
$dBName = "u98542p92708_pp"; 

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

