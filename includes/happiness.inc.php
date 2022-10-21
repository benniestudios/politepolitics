<?php

require_once 'dbh.inc.php';

$query = mysqli_query($conn, "SELECT * FROM users, buildings WHERE users.usersUid = buildings.buildingsUser;");

if (!$query) {
    die('Error: ' . mysqli_error($conn));
}

if(mysqli_num_rows($query) > 0){
    while($row = mysqli_fetch_assoc($query)) {
        if ($row["usersSetup"] === '1') {
            $happiness = $row['usersHappiness'];
            $population = $row['usersPopulation'];
            $RBCBcomp = $row['buildingsCB'] - $row['buildingsRB'];
            $usersTaxes = $row['usersTaxes'];
            $onlyonce = 0;
            
            $happysql = "UPDATE users, buildings SET usersHappiness = ((buildings.buildingsCB+1)*10-buildings.buildingsRB)/(users.usersTaxes/50)  WHERE users.usersUid = buildings.buildingsUser;";
            $stmt= $conn->prepare($happysql);
            $stmt->execute();


            

        }
    }
}

$query1 = mysqli_query($conn, "SELECT * FROM users, buildings WHERE users.usersUid = buildings.buildingsUser;");

if (!$query1) {
    die('Error: ' . mysqli_error($conn));
}

if(mysqli_num_rows($query1) > 0){
    while($row = mysqli_fetch_assoc($query1)) {

            if ($row['usersHappiness'] < 0) {
                $happysql4 = "UPDATE users, buildings SET usersHappiness = 0 WHERE users.usersUid = buildings.buildingsUser;";
                $stmt= $conn->prepare($happysql4);
                $stmt->execute();
            }

            $happiness = $row['usersHappiness'];
            $alreadydone = 0;

            if ($happiness < 50 and $alreadydone == 0) {
                $username = $row['usersUid'];
                $unhappysql3 = "INSERT INTO evts (evtsUser, evtsTitel, evtsMessage) VALUES('$username', 'unhappy', 'Your population is very unhappy and started rioting! 100 people have decided to leave the nation in search for a better place.')";
                $stmt= $conn->prepare($unhappysql3);
                $stmt->execute();

                $unhappysqlpop = "UPDATE users SET usersPopulation=usersPopulation-100 WHERE usersUid='$username'";
                $stmt= $conn->prepare($unhappysqlpop);
                $stmt->execute();
                $alreadydone=1;
            }   

            
            if ($happiness > 100) {
                $username = $row['usersUid'];
                $happysql6 = "UPDATE users, buildings SET usersHappiness = 100 WHERE users.usersUid = '$username';";
                $stmt= $conn->prepare($happysql6);
                $stmt->execute();
            }


        }
    }
