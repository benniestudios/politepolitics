<?php
          include_once '../includes/header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $userid = $_SESSION["userid"];
    $username = $_SESSION["useruid"];
    $query = mysqli_query($conn, "SELECT * FROM users, cities WHERE usersId='$userid' AND citiesUid='$username';");

    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)) {
    if ($row["usersSetup"] === '1') {
    echo "
    <center>
        <table class='headergame'>
            <h1 class='headergame' id='bank'>Nation</h1>
            <tr><th>&#129333 Leader name</th><td>" . $row["usersUid"]. "</td></tr>
            <tr><th>&#127757 Nation</th><td>" . $row["usersFlag"] . $row["usersNationName"]. "</td></tr>
            <tr><th>&#128220 Form of government</th><td>" . $row["usersNationType"]. "</td></tr>
            <tr><th>&#127794 Biome 1</th><td>" . $row["usersBiome"] . "</td></tr>
            <tr><th>&#127795 Biome 2</th><td>" . $row["usersBiome2"] . "</td></tr>
            <tr><th>&#128184 Tax Percentage</th><td>" . $row["usersTaxes"]. "%</td></tr>
            <tr><th>&#128515 Happiness</th><td>" . $row["usersHappiness"]. "%</td></tr>
            <tr><th>&#129351 Score</th><td>" . number_format($row["usersTotalscore"]). "</td></tr>
            <tr><th style='background-color:white; border: none;'></th><td style='background-color:white;border: none;'></td></tr>
            <tr><th>&#127970 Capital City</th><td>" . $row["citiesCapital"]. "</td></tr>
            <tr><th>&#128106 Population</th><td>" . number_format($row["usersPopulation"]) . "</td></tr>
        </table>


    </center>";
    }
    else {
    header('location: setup.php?error=notsetup');
    }
    }

    }else{

    header('location: setup.php?error=somethingwentwrong');
    }
    ?>
</div>


<?php
          include_once '../includes/footer.php';
        ?>
