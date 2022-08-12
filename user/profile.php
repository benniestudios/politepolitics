<?php
          include_once '../includes/header.php';
?>

<div class="game">
    <?php

    $getName = $_GET['user'];

    $result = mysqli_query($conn, "SELECT * FROM cities, users WHERE citiesUid='$getName' AND usersUid='$getName';");

      if (!$query)
      {
        die('Error: ' . mysqli_error($conn));
      }

      if(mysqli_num_rows($result) > 0){
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
            <h1 class='headergame' id='bank'>" . $row["usersUid"]. "'s Profile</h1>
            <tr><th>Leader name</th><td>" . $row["usersUid"]. "</td></tr>
            <tr><th>Nation</th><td>" . $row["usersNationName"]. "</td></tr>
            <tr><th>Form of government</th><td>" . $row["usersNationType"]. "</td></tr>
            <tr><th>&#127794 Biome 1</th><td>" . $row["usersBiome"] . "</td></tr>
            <tr><th>&#127795 Biome 2</th><td>" . $row["usersBiome2"] . "</td></tr>
            <tr><th>Research Points</th><td>" . $row["usersRP"]. "</td></tr>
            <tr><th>Taxes</th><td>" . $row["usersTaxes"]. "%</td></tr>
            <tr><th>Collected daily reward?</th><td>" . $showdaily. "</td></tr>
            <tr><th>Capital City</th><td>" . $row["citiesCapital"]. "</td></tr>
            <tr><th>City Population</th><td>" . number_format($row["usersPopulation"]). "</td></tr>
            <tr><th>Amount of cities</th><td>" . $row["citiesAmount"]. "</td></tr>
        </table>
    </center>";
    }
    }




    ?>
</div>


<?php
          include_once '../includes/footer.php';
        ?>
