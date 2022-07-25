<?php

$serverName = "localhost";
$dBUsername = "root"; //! u98542p92708_ppbs for production
$dBPassword = ""; //! 5TK3jghym9eGzWqY for production
$dBName = "u98542p92708_pp"; 

// file deepcode ignore HardcodedPassword: will fix this later
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

