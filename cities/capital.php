<?php
          include_once 'header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $username = $_SESSION["useruid"];

    // City Info / Statistics
    $query = mysqli_query($conn, "SELECT * FROM cities WHERE citiesUid='$username';");

    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)) {
            echo "<h1 class='headergame' id='bank'>City Overview</h1>";
            echo "<h1 class='headergame' id='nationsheader'>City Statistics</h1>";
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
                            <td>" . $row["citiesCapitalPopulation"]. "</td>
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
            echo "<h1 class='headergame' id='nationsheader'>Buildings</h1>";
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
    $queryBuildings = mysqli_query($conn, "SELECT * FROM production WHERE productionUser='$username';");

    if (!$queryBuildings)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($queryBuildings) > 0){

    while($row = mysqli_fetch_assoc($queryBuildings)) {
            echo "

                        <tr>
                            <td>Production: " . $row['productionFood'] . "</td>
                            <td>Production: " . $row['productionCoal'] . "</td>
                            <td>Production: " . $row['productionIron'] . "</td>
                        </tr>
                    </table>
                </center>

                ";

        }
    }
    ?>
</div>


<?php
          include_once 'footer.php';
        ?>
