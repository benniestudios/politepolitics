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

function setupUser($conn, $nationname, $nationtype, $userid, $color) {
    $numberone = 1;
    $nationfill = "<p style='color:$color;font-weight:bold;text-shadow: 2px 2px 10px black;'>$nationname</p>";
    $sql = "UPDATE users SET usersNationName=?, usersNationType=?, usersSetup=? WHERE usersId=?;";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ssii", $nationfill, $nationtype, $numberone, $userid);
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
    header("location: ../user/daily.php?error=worked");
    exit();
}

// Countryside buildings 1

function buildCapitalFarm($conn, $build, $username) {
    $sql = "UPDATE buildings, production, users SET buildingsFarm=buildingsFarm+1, production.productionFood=(buildings.buildingsFarm)*5, users.usersMoney = users.usersMoney - 10000 * POWER(buildingsFarm, 2) WHERE buildingsUser= ? AND users.usersUid = ? AND buildings.buildingsUser = production.productionUser AND buildingsFarm < buildingsMax AND usersMoney > buildingsFarmPrice";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    $sql2 = "UPDATE buildings, users SET buildingsFarmPrice = 10000 * POWER(buildingsFarm+1, 2)  WHERE buildingsUser= ? AND usersUid=?;";
    $stmt= $conn->prepare($sql2);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    header("location: ../../cities/capital.php?error=worked");
    exit();
}

function buildCapitalCoalmine($conn, $build, $username) {
    $sql = "UPDATE buildings, production, users SET buildingsCoalmine=buildingsCoalmine+1, production.productionCoal=(buildings.buildingsCoalmine)*5, users.usersMoney = users.usersMoney - 15000 * POWER(buildingsCoalmine, 2) WHERE buildingsUser= ? AND users.usersUid = ? AND buildings.buildingsUser = production.productionUser AND buildingsCoalmine < buildingsMax AND usersMoney > buildingsCoalminePrice";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    $sql2 = "UPDATE buildings, users SET buildingsCoalminePrice = 15000 * POWER(buildingsCoalmine+1, 2)  WHERE buildingsUser= ? AND usersUid=?;";
    $stmt= $conn->prepare($sql2);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    header("location: ../../cities/capital.php?error=worked");
    exit();
}

function buildCapitalIronmine($conn, $build, $username) {
    $sql = "UPDATE buildings, production, users SET buildingsIronmine=buildingsIronmine+1, production.productionIron=(buildings.buildingsIronmine)*5, users.usersMoney = users.usersMoney - 20000 * POWER(buildingsIronmine, 2) WHERE buildingsUser= ? AND users.usersUid = ? AND buildings.buildingsUser = production.productionUser AND buildingsIronmine < buildingsMax AND usersMoney > buildingsIronminePrice";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    $sql2 = "UPDATE buildings, users SET buildingsIronminePrice = 20000 * POWER(buildingsIronmine+1, 2)  WHERE buildingsUser= ? AND usersUid=?;";
    $stmt= $conn->prepare($sql2);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    header("location: ../../cities/capital.php?error=worked");
    exit();
}

// Capital buildings

function buildCapitalResidential($conn, $build, $username) {
    $sql = "UPDATE buildings, production, users SET buildingsRB = buildingsRB + 1, users.usersPopulation = users.usersPopulation + users.usersPopulationAdd, users.usersMoney = users.usersMoney - 500 * POWER(buildingsRB, 2), usersPopulationAdd=usersPopulationAdd+(500*RAND()), usersMoneyperhour = usersTaxes * 0.01 * usersPopulation / 5 + usersHappiness + usersMoneyfactor WHERE buildingsUser= ? AND users.usersUid = ? AND buildings.buildingsUser = production.productionUser AND buildingsRB < buildingsMax AND usersMoney > buildingsRBPrice AND buildings.buildingsUser = users.usersUid;";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    $sql2 = "UPDATE buildings, users SET buildingsRBPrice = 500 * POWER(buildingsRB+1, 2)  WHERE buildingsUser= ? AND usersUid=?;";
    $stmt= $conn->prepare($sql2);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    header("location: ../../cities/capital.php?error=worked");
    exit();
}

function buildCapitalCommercial($conn, $build, $username) {
    $sql = "UPDATE buildings, production, users SET buildingsCB = buildingsCB + 1, users.usersMoneyfactor = buildingsCB * 50, users.usersMoney = users.usersMoney - 500 * POWER(buildingsCB, 2), usersMoneyperhour = usersTaxes * 0.01 * usersPopulation / 10 + usersHappiness + usersMoneyfactor WHERE buildingsUser= ? AND users.usersUid = ? AND buildings.buildingsUser = production.productionUser AND buildingsCB < buildingsMax AND usersMoney > buildingsCBPrice AND buildings.buildingsUser = users.usersUid;";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    $sql2 = "UPDATE buildings, users SET buildingsCBPrice = 800 * POWER(buildingsCB+1, 2)  WHERE buildingsUser= ? AND usersUid=?;";
    $stmt= $conn->prepare($sql2);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    header("location: ../../cities/capital.php?error=worked");
    exit();
}

// Countryside buildings 2

function buildCapitalOil($conn, $build, $username) {
    $sql = "UPDATE buildings, production, users SET buildingsOil=buildingsOil+1, production.productionOil=(buildings.buildingsOil)*3, users.usersMoney = users.usersMoney - 35000 * POWER(buildingsOil, 2) WHERE buildingsUser= ? AND users.usersUid = ? AND buildings.buildingsUser = production.productionUser AND buildingsOil < buildingsMax AND usersMoney > buildingsOilPrice";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    $sql2 = "UPDATE buildings, users SET buildingsOilPrice = 35000 * POWER(buildingsOil+1, 2)  WHERE buildingsUser= ? AND usersUid=?;";
    $stmt= $conn->prepare($sql2);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    header("location: ../../cities/capital.php?error=worked");
    exit();
}

function buildCapitalUranium($conn, $build, $username) {
    $sql = "UPDATE buildings, production, users SET buildingsUraniummine=buildingsUraniummine+1, production.productionUranium=(buildings.buildingsUraniummine)*2, users.usersMoney = users.usersMoney - 48000 * POWER(buildingsUraniummine, 2) WHERE buildingsUser= ? AND users.usersUid = ? AND buildings.buildingsUser = production.productionUser AND buildingsUraniummine < buildingsMax AND usersMoney > buildingsUraniumminePrice";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    $sql2 = "UPDATE buildings, users SET buildingsUraniumminePrice = 48000 * POWER(buildingsUraniummine+1, 2)  WHERE buildingsUser= ? AND usersUid=?;";
    $stmt= $conn->prepare($sql2);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    header("location: ../../cities/capital.php?error=worked");
    exit();
}

function buildCapitalSteel($conn, $build, $username) {
    $sql = "UPDATE buildings, production, users SET buildingsSteel=buildingsSteel+1, production.productionSteel=(buildings.buildingsSteel)*2.5, users.usersMoney = users.usersMoney - 42000 * POWER(buildingsSteel, 2) WHERE buildingsUser= ? AND users.usersUid = ? AND buildings.buildingsUser = production.productionUser AND buildingsSteel < buildingsMax AND usersMoney > buildingsSteelPrice";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    $sql2 = "UPDATE buildings, users SET buildingsSteelPrice = 42000 * POWER(buildingsIronmine+1, 2)  WHERE buildingsUser= ? AND usersUid=?;";
    $stmt= $conn->prepare($sql2);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    header("location: ../../cities/capital.php?error=worked");
    exit();
}

function sellResources($conn, $resource, $amount, $price, $username) {
    $sql = "INSERT INTO market (marketUser, marketItem, marketQuantity, marketPrice) VALUES(?, ?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $username, $resource, $amount, $price);
    $stmt->execute();

    header("location: ../market/index.php?error=worked");
    exit();
}