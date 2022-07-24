<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "u98542p92708_pp"; 

// file deepcode ignore HardcodedPassword: will fix this later
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

