<?php

require_once 'dbh.inc.php';

date_default_timezone_set('UTC');
$time = date('H:i');
$sql = "UPDATE users SET usersExactTime='$time', usersTotalScore=usersMoney+usersPopulation*2+usersHappiness";

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

$url = 'https://betteruptime.com/api/v1/heartbeat/3kfqtzfvaN1QohTCd3q5rEkm';
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