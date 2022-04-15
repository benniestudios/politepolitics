<?php
          include_once 'header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    
    $getName = $_GET['user'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE usersUid='$getName';");
    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 0) {
        header("Location: index.php");
    }
    else {
    while($row = mysqli_fetch_assoc($result)) {

        if ($row['usersDaily'] == 1) {
            $showdaily = 'No';
        }    
        else {
            $showdaily = 'Yes';
        }

        echo "
    <center>
        <table class='headergame'>
            <h1 class='headergame' id='bank'>Profile</h1>
            <tr><th>Leader name</th><td>" . $row["usersUid"]. "</td></tr>
            <tr><th>Nation</th><td>" . $row["usersNationName"]. "</td></tr>
            <tr><th>Form of government</th><td>" . $row["usersNationType"]. "</td></tr>
            <tr><th>Research Points</th><td>" . $row["usersRP"]. "</td></tr>
            <tr><th>Taxes</th><td>" . $row["usersTaxes"]. "%</td></tr>
            <tr><th>Collected daily reward?</th><td>" . $showdaily. "</td></tr>
        </table>
    </center>";
    }
    }

    $result1 = mysqli_query($conn, "SELECT * FROM cities WHERE citiesUid='$getName';");
    $num_rows1 = mysqli_num_rows($result1);
    while($row = mysqli_fetch_assoc($result1)) {

        echo "
    <center>
        <table class='headergame'>
            <h1 class='headergame' id='bank'>Cities</h1>
            <tr><th>Capital City</th><td>" . $row["citiesCapital"]. "</td>
                <th>City Population</th><td>" . $row["citiesCapitalPopulation"]. "</td></tr>
            <tr><th>Amount of cities</th><td>" . $row["citiesAmount"]. "</td></tr>
        </table>
    </center>";
    }


    ?>
</div>


<?php
          include_once 'footer.php';
        ?>