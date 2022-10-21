<?php
          include_once '../includes/header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $userid = $_SESSION["userid"];
    $username = $_SESSION["useruid"];
    
    $query = mysqli_query($conn, "SELECT * FROM users, cities, evts WHERE usersId='$userid' AND citiesUid='$username' AND evtsUser='$username' ORDER BY evtsId DESC LIMIT 15;");


    echo "
    <center>
    <table class='headergame'>
        <h1 class='headergame' id='bank'>Events</h1>
        <tr>
            <th>Event</th>
            <th>Date</th>
        </tr>";

    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) >= 0){

    while($row = mysqli_fetch_assoc($query)) {
    if ($row["usersSetup"] === '1') {

        if ($row['evtsTitel'] == 'war') {
            $backgroundcolor = 'darkred';
            $color = 'white';
        } elseif ($row['evtsTitel'] == 'unhappy') {
            $backgroundcolor = 'orange';
            $color = 'black';
        } elseif ($row['evtsTitel'] == 'sell') {
            $backgroundcolor = 'lightgreen';
            $color = 'black';
        } else {
            $backgroundcolor = 'lightyellow';
            $color = 'black';
        }

        echo "
        
            <tr style='" . "background-color:" . $backgroundcolor . ";" . "color:" . $color . ";'>
                <td>" . $row['evtsMessage'] . "</td>
                <td>" . $row['evtsDate'] . "</td>
            </tr>
        
        ";
    }
    else {
    header('location: events.php?error=notsetup');
    }
    }

    }else{

    header('location: events.php?error=somethingwentwrong');
    }

    echo "</table>
        </center>";

    ?>

</div>


<?php
          include_once '../includes/footer.php';
        ?>
