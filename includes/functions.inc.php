<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) {
    $result;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
    $result;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql2 = "INSERT INTO cities (citiesUid) VALUES (?)";
    $stmt= $conn->prepare($sql2);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $sql3 = "INSERT INTO items (itemsUser) VALUES (?)";
    $stmt= $conn->prepare($sql3);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    header("location: ../signup.php?error=none");
    exit();
}

function emptyInputLogin($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username, $username);



    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    elseif ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] =  $uidExists["usersId"];
        $_SESSION["useruid"] =  $uidExists["usersUid"];
        header("location: ../user/index.php");
        exit();
    }
}

function emptyInputSetup($nationname, $nationtype) {
    $result;
    if (empty($nationname) || empty($nationtype)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function emptyInputCapital($citiename) {
    $result;
    if (empty($citiename)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function setupUser($conn, $nationname, $nationtype, $userid) {
    $numberone = 1;
    $sql = "UPDATE users SET usersNationName=?, usersNationType=?, usersSetup=? WHERE usersId=?;";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ssii", $nationname, $nationtype, $numberone, $userid);
    $stmt->execute();

    header("location: ../user/index.php?error=worked");

    exit();
}

function setupCapital($conn, $citiename, $useruid) {
    $numberone = 1;
    $sql = "UPDATE cities SET citiesCapital=?, citiesAmount=? WHERE citiesUid=?;";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("sis", $citiename, $numberone, $useruid);
    $stmt->execute();

    # update money amount (the cost of the city)
    $sql2 = "UPDATE users SET usersMoney=usersMoney-100000, usersPopulation=usersPopulation+100 WHERE usersUid=?;";
    $stmt= $conn->prepare($sql2);
    $stmt->bind_param("s", $useruid);
    $stmt->execute();

    # Insert username into the buildings table for the capital city.
    $sql3 = "INSERT INTO buildings (buildingsUser) VALUES (?);";
    $stmt= $conn->prepare($sql3);
    $stmt->bind_param("s", $useruid);
    $stmt->execute();

    $sql3 = "INSERT INTO production (productionUser) VALUES (?);";
    $stmt= $conn->prepare($sql3);
    $stmt->bind_param("s", $useruid);
    $stmt->execute();

    header("location: ../cities/index.php?error=worked");

    exit();
}

function moremoney($conn, $userid) {
    $time = date('H:i:s');
    $numberzero = 0;
    $sql = "UPDATE users SET usersMoney=usersMoney+5000, usersDaily=?, usersTime=? WHERE usersId=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("isi", $numberzero, $time, $userid);
    $stmt->execute();

    header("location: ../user/index.php?error=worked");



    exit();
}
