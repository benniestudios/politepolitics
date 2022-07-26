<?php
          include_once '../includes/header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $userid = $_SESSION["useruid"];
    $query = mysqli_query($conn, "SELECT * FROM cities, users WHERE citiesUid='$userid' AND usersUid='$userid';");

    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) > 0){
    echo "<h1 class='headergame' id='nationsheader'>🌆 Cities 🌆</h1>";

    while($row = mysqli_fetch_assoc($query)) {
        if ($row['citiesCapital'] != 0) {
            echo "
                <center>
                        <table class='citiestable' id='citiestable'>
                        <tr>
                            <td><a href='capital.php'>" . $row["citiesCapital"]. "</a></td>
                            <td>" . number_format($row["usersPopulation"]) . "</td>
                            <td>Capital</td>
                        </tr>


                    </table>
                    <br><br><br><br><br><br><br><br><br><br>
                </center>";
            }
            else {
	            header('location: capitalcitysetup.php');
            }

        }
    }
    ?>
</div>

<script src="../javascript/cities.js"></script>
<?php
          include_once '../includes/footer.php';
        ?>
