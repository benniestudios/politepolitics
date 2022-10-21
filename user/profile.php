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
            <tr><th><img src='../images/emoji/E183.svg' class='emojilarge'> Leader name</th><td>" . $row["usersUid"]. "</td></tr>
            <tr><th><img src='../images/emoji/1F30D.svg' class='emojilarge'> Nation</th><td>" . $row["usersFlag"] . " " . $row["usersNationName"]. "</td></tr>
            <tr><th><img src='../images/emoji/1F4E6.svg' class='emojilarge'> Color Trade Bloc</th><td><center><div id='tradebloc' style='background-color:" . $row["usersColor"] . ";'> </div></center></td></tr>
            <tr><th><img src='../images/emoji/1F3DB.svg' class='emojilarge'> Form of government</th><td>" . $row["usersNationType"]. "</td></tr>
            <tr><th><img src='../images/emoji/1F332.svg' class='emojilarge'> Biome 1</th><td>" . $row["usersBiome"] . "</td></tr>
            <tr><th><img src='../images/emoji/1F333.svg' class='emojilarge'> Biome 2</th><td>" . $row["usersBiome2"] . "</td></tr>
            <tr><th><img src='../images/emoji/1F52C.svg' class='emojilarge'> Research Points</th><td>" . $row["usersRP"]. "</td></tr>
            <tr><th><img src='../images/emoji/1FA99.svg' class='emojilarge'> Taxes</th><td>" . $row["usersTaxes"]. "%</td></tr>
            <tr><th><img src='../images/emoji/1F381.svg' class='emojilarge'> Collected Daily Reward?</th><td>" . $showdaily. "</td></tr>
            <tr><th><img src='../images/emoji/1F3D9.svg' class='emojilarge'> Capital City</th><td>" . $row["citiesCapital"]. "</td></tr>
            <tr><th><img src='../images/emoji/1F46A.svg' class='emojilarge'> Population</th><td>" . number_format($row["usersPopulation"]). "</td></tr>
            <tr><th><img src='../images/emoji/1F3EC.svg' class='emojilarge'> Amount of cities</th><td>" . $row["citiesAmount"]. "</td></tr>
        </table>
    </center>";
    }
    }




    ?>
</div>


<?php
          include_once '../includes/footer.php';
        ?>
