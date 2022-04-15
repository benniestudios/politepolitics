<?php
session_start();
$_SESSION["gamename"] = $_POST["gamename"];

header("location: ../user/index.php");
