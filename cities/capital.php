<?php
          include_once 'header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $username = $_SESSION["useruid"];

    // City Info / Statistics
    $query = mysqli_query($conn, "SELECT * FROM cities, users WHERE citiesUid='$username' and usersUid = '$username';");

    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)) {
            echo "<h1 class='headergame' id='bank'>" . $row['citiesCapital'] . "</h1>";
            echo "<h1 class='headergame' id='nationsheader'>Statistics</h1>";
            echo "<table class='nationstable'>
                <tr>
                    <th>Population</th>
                    <th>Type</th>
                </tr>
              </table>";
            echo "
                <center>
                    <table class='nationstable'>
                        <tr>
                            <td>" . number_format($row["usersPopulation"]) . "</td>
                            <td>Capital</td>
                        </tr>


                    </table>
                </center>

                ";

        }
    }


    // City Buildings
    $queryBuildings = mysqli_query($conn, "SELECT * FROM buildings WHERE buildingsUser='$username';");

    if (!$queryBuildings)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($queryBuildings) > 0){

    while($row = mysqli_fetch_assoc($queryBuildings)) {
            echo "<h1 class='headergame' id='nationsheader'>City Buildings</h1>";
            echo "
                <center>
                    <table class='buildingstable'>
                        <tr>
                            <th>Residential Buildings</th>
                            <th>Commercial Buildings</th>
                            <br>
                        </tr>

                        <tr>
                            <td>Amount: " . $row['buildingsRB'] . " </td>
                            <td>Amount: " . $row['buildingsCB'] . " </td>
                        </tr>

                ";

        }
    }

    // City Production
    $queryProduction = mysqli_query($conn, "SELECT * FROM production WHERE productionUser='$username';");

    if (!$queryProduction)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($queryProduction) > 0){

    while($row = mysqli_fetch_assoc($queryProduction)) {
            echo "

                        <tr>
                            <td>+ 1,000 population</td>
                            <td>+ 50 money/hour</td>
                        </tr>

                        <tr>
                            <td><img src='../images/resident.jpg' width='100%' height='150px;'><br><br>Your people need a place to live! Build some homes for them. You don't want them to sleep outside.<br><br><div style='color: red;'>More citizens!</div></td>
                            <td><img src='../images/commercial.jpg' width='100%' height='150px;'><br><br>People need to work and earn money for your nation.<br><br><div style='color: red;'>More money!</div></td>
                        </tr>

                        <tr>
                            <td>
                                <form action='../includes/cities/build.inc.php' method='post'>
                                    <button type='submit' name='build' value='residential'>Build</button>
                                </form>
                                </td>
                            <td>
                                <form action='../includes/cities/build.inc.php' method='post'>
                                    <button type='submit' name='build' value='commercial'>Build</button>
                                </form>
                            </td>
                        </tr>


                ";

        }
    }

    $queryBuildings = mysqli_query($conn, "SELECT * FROM buildings, users WHERE buildingsUser='$username' AND usersUid='$username';");

    if (!$queryBuildings)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($queryBuildings) > 0){

    while($row = mysqli_fetch_assoc($queryBuildings)) {
            echo "
                    <tr>
                        <td>Price: " . number_format($row['buildingsRBPrice']) . "</td>
                        <td>Price: " . number_format($row['buildingsCBPrice']) . "</td>
                    </tr>
                </table>
            </center>

            ";
            if ($row['usersMoney'] < $row['buildingsRBPrice'] and $row['usersMoney'] >= $row['buildingsCBPrice']) {
                echo "
                    <center>
                        <table class='buildingstable'>
                            <tr>
                                <td style='color: red;'>Not enough resources!</td>
                                <td style='color: green;'>You have enough resources!</td>
                            </tr>
                        </table>
                    </center>

                ";
            } elseif ($row['usersMoney'] >= $row['buildingsRBPrice'] and $row['usersMoney'] < $row['buildingsCBPrice']) {
                echo "
                    <center>
                        <table class='buildingstable'>
                            <tr>
                                <td style='color: green;'>You have enough resources!</td>
                                <td style='color: red;'>Not enough resources!</td>
                            </tr>
                        </table>
                    </center>

                ";
            } elseif ($row['usersMoney'] < $row['buildingsRBPrice'] and $row['usersMoney'] < $row['buildingsCBPrice']) {
                echo "
                    <center>
                        <table class='buildingstable'>
                            <tr>
                                <td style='color: red;'>Not enough resources!</td>
                                <td style='color: red;'>Not enough resources!</td>
                            </tr>
                        </table>
                    </center>

                ";
            } else {
                echo "
                    <center>
                        <table class='buildingstable'>
                            <tr>
                                <td style='color: green;'>You have enough resources!</td>
                                <td style='color: green;'>You have enough resources!</td>
                            </tr>
                        </table>
                    </center>

                ";


        }
    }
}








    // City Buildings 2
    $queryBuildings = mysqli_query($conn, "SELECT * FROM buildings WHERE buildingsUser='$username';");

    if (!$queryBuildings)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($queryBuildings) > 0){

    while($row = mysqli_fetch_assoc($queryBuildings)) {
            echo "<h1 class='headergame' id='nationsheader'>Countryside Buildings</h1>";
            echo "
                <center>
                    <table class='buildingstable'>
                        <tr>
                            <th>Farm</th>
                            <th>Coal Mine</th>
                            <th>Iron Mine</th>
                        </tr>

                        <tr>
                            <td>Amount: " . $row['buildingsFarm'] . " </td>
                            <td>Amount: " . $row['buildingsCoalmine'] . " </td>
                            <td>Amount: " . $row['buildingsIronmine'] . " </td>
                        </tr>

                ";

        }
    }

    // City Production
    $queryProduction = mysqli_query($conn, "SELECT * FROM production WHERE productionUser='$username';");

    if (!$queryProduction)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($queryProduction) > 0){

    while($row = mysqli_fetch_assoc($queryProduction)) {
            echo "

                        <tr>
                            <td>Production: " . $row['productionFood'] . " food/hour</td>
                            <td>Production: " . $row['productionCoal'] . " coal/hour</td>
                            <td>Production: " . $row['productionIron'] . " iron/hour</td>
                        </tr>

                        <tr>
                            <td><img src='../images/farm.jpg' width='100%' height='150px;'><br><br>Your people need something to eat! Build some farms so your people don't starve to death.<br><br><div style='color: red;'>Produces food</div></td>
                            <td><img src='../images/coalmine.jpg' width='100%' height='150px;'><br><br>Can be used for our coal power plants. Might not be good for the environment, but it's cheap.<br><br><div style='color: red;'>Produces coal</div></td>
                            <td><img src='../images/ironmine.jpg' width='100%' height='150px;'><br><br>Iron can be turned into steel, which will be useful for building structures.<br><br><div style='color: red;'>Produces iron</div></td>
                        </tr>

                        <tr>
                            <td>
                                <form action='../includes/cities/build.inc.php' method='post'>
                                    <button type='submit' name='build' value='food'>Build</button>
                                </form>
                            </td>
                            <td>
                                <form action='../includes/cities/build.inc.php' method='post'>
                                    <button type='submit' name='build' value='coal'>Build</button>
                                </form>
                            </td>
                            <td>
                                <form action='../includes/cities/build.inc.php' method='post'>
                                    <button type='submit' name='build' value='iron'>Build</button>
                                </form>
                            </td>
                        </tr>


                ";

        }
    }

    $queryBuildings = mysqli_query($conn, "SELECT * FROM buildings, users WHERE buildingsUser='$username' AND usersUid='$username';");

    if (!$queryBuildings)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($queryBuildings) > 0){

    while($row = mysqli_fetch_assoc($queryBuildings)) {
            echo "
                    <tr>
                        <td>Price: " . number_format($row['buildingsFarmPrice']) . "</td>
                        <td>Price: " . number_format($row['buildingsCoalminePrice']) . "</td>
                        <td>Price: " . number_format($row['buildingsIronminePrice']) . "</td>
                    </tr>
                </table>
            </center>

            ";
            if ($row['usersMoney'] < $row['buildingsFarmPrice'] and $row['usersMoney'] >= $row['buildingsCoalminePrice'] and $row['usersMoney'] >= $row['buildingsIronminePrice']) {
                echo "
                    <center>
                        <table class='buildingstable'>
                            <tr>
                                <td style='color: red;'>Not enough resources!</td>
                                <td style='color: green;'>You have enough resources!</td>
                                <td style='color: green;'>You have enough resources!</td>
                            </tr>
                        </table>
                    </center>

                ";
            } elseif ($row['usersMoney'] >= $row['buildingsFarmPrice'] and $row['usersMoney'] < $row['buildingsCoalminePrice'] and $row['usersMoney'] >= $row['buildingsIronminePrice']) {
                echo "
                    <center>
                        <table class='buildingstable'>
                            <tr>
                                <td style='color: green;'>You have enough resources!</td>
                                <td style='color: red;'>Not enough resources!</td>
                                <td style='color: green;'>You have enough resources!</td>
                            </tr>
                        </table>
                    </center>

                ";
            } elseif ($row['usersMoney'] >= $row['buildingsFarmPrice'] and $row['usersMoney'] >= $row['buildingsCoalminePrice'] and $row['usersMoney'] < $row['buildingsIronminePrice']) {
                echo "
                    <center>
                        <table class='buildingstable'>
                            <tr>
                                <td style='color: green;'>You have enough resources!</td>
                                <td style='color: green;'>You have enough resources!</td>
                                <td style='color: red;'>Not enough resources!</td>
                            </tr>
                        </table>
                    </center>

                ";
            } elseif ($row['usersMoney'] < $row['buildingsFarmPrice'] and $row['usersMoney'] < $row['buildingsCoalminePrice'] and $row['usersMoney'] >= $row['buildingsIronminePrice']) {
                echo "
                    <center>
                        <table class='buildingstable'>
                            <tr>
                                <td style='color: red;'>Not enough resources!</td>
                                <td style='color: red;'>Not enough resources!</td>
                                <td style='color: green;'>You have enough resources!</td>
                            </tr>
                        </table>
                    </center>

                ";
            } elseif ($row['usersMoney'] < $row['buildingsFarmPrice'] and $row['usersMoney'] >= $row['buildingsCoalminePrice'] and $row['usersMoney'] < $row['buildingsIronminePrice']) {
                echo "
                    <center>
                        <table class='buildingstable'>
                            <tr>
                                <td style='color: red;'>Not enough resources!</td>
                                <td style='color: green;'>You have enough resources!</td>
                                <td style='color: red;'>Not enough resources!</td>
                            </tr>
                        </table>
                    </center>

                ";
            } elseif ($row['usersMoney'] >= $row['buildingsFarmPrice'] and $row['usersMoney'] < $row['buildingsCoalminePrice'] and $row['usersMoney'] < $row['buildingsIronminePrice']) {
                echo "
                    <center>
                        <table class='buildingstable'>
                            <tr>
                                <td style='color: green;'>You have enough resources!</td>
                                <td style='color: red;'>Not enough resources!</td>
                                <td style='color: red;'>Not enough resources!</td>
                            </tr>
                        </table>
                    </center>

                ";
            } elseif ($row['usersMoney'] < $row['buildingsFarmPrice'] and $row['usersMoney'] < $row['buildingsCoalminePrice'] and $row['usersMoney'] < $row['buildingsIronminePrice']) {
                echo "
                    <center>
                        <table class='buildingstable'>
                            <tr>
                                <td style='color: red;'>Not enough resources!</td>
                                <td style='color: red;'>Not enough resources!</td>
                                <td style='color: red;'>Not enough resources!</td>
                            </tr>
                        </table>
                    </center>

                ";
            } else {
                echo "
                    <center>
                        <table class='buildingstable'>
                            <tr>
                                <td style='color: green;'>You have enough resources!</td>
                                <td style='color: green;'>You have enough resources!</td>
                                <td style='color: green;'>You have enough resources!</td>
                            </tr>
                        </table>
                    </center>

                ";
            }


        }
    }

    ?>
</div>


<?php
          include_once 'footer.php';
        ?>
