<?php
          include_once 'header.php';
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
            <tr><th>Leader name</th><td>" . $row["usersUid"]. "</td></tr>
            <tr><th>Nation</th><td>" . $row["usersNationName"]. "</td></tr>
            <tr><th>Form of government</th><td>" . $row["usersNationType"]. "</td></tr>
            <tr><th>Tax Percentage</th><td>" . $row["usersTaxes"]. "%</td></tr>
            <tr><th>Population Happiness</th><td>" . $row["usersHappiness"]. "%</td></tr>
            <tr><th>Score</th><td>" . number_format($row["usersTotalscore"]). "</td></tr>
            <tr><th style='background-color:white; border: none;'></th><td style='background-color:white;border: none;'></td></tr>
            <tr><th>Capital City</th><td>" . $row["citiesCapital"]. "</td></tr>
            <tr><th>Population</th><td>" . number_format($row["usersPopulation"]) . "</td></tr>
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
          include_once 'footer.php';
        ?>
