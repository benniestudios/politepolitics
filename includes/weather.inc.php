<?php

require_once 'dbh.inc.php';

$apiKey = "740c45c00e843bbed22eacba7e1e947c";
$cityId = "Amsterdam";
$googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?q=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();

$weather = $data->weather[0]->main;
$temp = $data->main->temp;
$description = $data->weather[0]->description;
echo $data->main->temp;
echo $weather;

$sql = "UPDATE weather SET weatherName='$weather', weatherTemp=$temp, weatherShow=1, weatherDesc='$description';";

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