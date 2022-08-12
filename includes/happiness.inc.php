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
            $happysql = "UPDATE users, buildings SET usersHappiness = usersHappiness + (buildingsCB - buildingsRB) WHERE users.usersUid = buildings.buildingsUser;";
            $stmt= $conn->prepare($happysql);
            $stmt->execute();

        }
    }
}