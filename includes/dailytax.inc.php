<?php

require_once 'dbh.inc.php';

$sql = "UPDATE users SET usersMoney=usersMoney+usersMoneyperhour;";

$sqlFood = "UPDATE production, buildings SET production.productionFood=(buildings.buildingsFarm)*5 WHERE buildings.buildingsUser = production.productionUser";
$sqlCoal = "UPDATE production, buildings SET production.productionCoal=(buildings.buildingsCoalmine)*5 WHERE buildings.buildingsUser = production.productionUser";
$sqlIron = "UPDATE production, buildings SET production.productionIron=(buildings.buildingsIronmine)*5 WHERE buildings.buildingsUser = production.productionUser";
$sqlFood = "UPDATE production, buildings SET production.productionOil=(buildings.buildingsOil)*3 WHERE buildings.buildingsUser = production.productionUser";
$sqlCoal = "UPDATE production, buildings SET production.productionUranium=(buildings.buildingsUraniummine)*2 WHERE buildings.buildingsUser = production.productionUser";
$sqlIron = "UPDATE production, buildings SET production.productionSteel=(buildings.buildingsSteel)*2.5 WHERE buildings.buildingsUser = production.productionUser";

$sqlSetFood = "UPDATE production, items SET items.itemsFood=items.itemsFood + production.productionFood WHERE items.itemsUser = production.productionUser";
$sqlSetCoal = "UPDATE production, items SET items.itemsCoal=items.itemsCoal + production.productionCoal WHERE items.itemsUser = production.productionUser";
$sqlSetIron = "UPDATE production, items SET items.itemsIron=items.itemsIron + production.productionIron WHERE items.itemsUser = production.productionUser";
$sqlSetOil = "UPDATE production, items SET items.itemsOil=items.itemsOil + production.productionOil WHERE items.itemsUser = production.productionUser";
$sqlSetUranium = "UPDATE production, items SET items.itemsUranium=items.itemsUranium + production.productionUranium WHERE items.itemsUser = production.productionUser";
$sqlSetSteel = "UPDATE production, items SET items.itemsSteel=items.itemsSteel + production.productionSteel WHERE items.itemsUser = production.productionUser";

$sqlMoneyperhour = "UPDATE users, buildings SET usersMoneyfactor=buildingsCB*50, usersMoneyperhour = usersTaxes * 0.01 * usersPopulation / 5 + usersHappiness + usersMoneyfactor WHERE buildings.buildingsUser = users.usersUid";

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

if (mysqli_query($conn, $sqlSetFood)) {
    echo 'worked';
}  else {
    echo 'not working';
}

if (mysqli_query($conn, $sqlSetCoal)) {
    echo 'worked';
}  else {
    echo 'not working';
}

if (mysqli_query($conn, $sqlSetIron)) {
    echo 'worked';
}  else {
    echo 'not working';
}

if (mysqli_query($conn, $sqlSetOil)) {
    echo 'worked';
}  else {
    echo 'not working';
}

if (mysqli_query($conn, $sqlSetUranium)) {
    echo 'worked';
}  else {
    echo 'not working';
}

if (mysqli_query($conn, $sqlSetSteel)) {
    echo 'worked';
}  else {
    echo 'not working';
}

if (mysqli_query($conn, $sqlMoneyperhour)) {
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
