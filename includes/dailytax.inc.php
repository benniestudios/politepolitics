<?php

require_once 'dbh.inc.php';


$sql = "UPDATE users SET usersMoney=usersMoney+(usersTaxes*0.001*usersPopulation/5)+usersHappiness;";
$sqlFood = "UPDATE production, buildings SET production.productionFood=(SELECT buildingsFarm FROM buildings WHERE buildingsUser='Bennie')*5 WHERE production.productionUser='Bennie'";
$sqlCoal = "UPDATE production, buildings SET production.productionFood=(SELECT buildingsCoalmine FROM buildings WHERE buildingsUser='Bennie')*5 WHERE production.productionUser='Bennie'";
$sqlIron = "UPDATE production, buildings SET production.productionFood=(SELECT buildingsIronmine FROM buildings WHERE buildingsUser='Bennie')*5 WHERE production.productionUser='Bennie'";

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

if (mysqli_query($conn, $sqlFood)) {
    echo 'worked';
}  else {
    echo 'not working';
}

if (mysqli_query($conn, $sqlCoal)) {
    echo 'worked';
}  else {
    echo 'not working';
}

if (mysqli_query($conn, $sqlIron)) {
    echo 'worked';
}  else {
    echo 'not working';
}

$url = 'https://betteruptime.com/api/v1/heartbeat/unfcHSmkuHQta77vchTn1sut';
$data = array('key1' => 'value1', 'key2' => 'value2');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }

var_dump($result);
