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
        <h1 class='headergame' id='bank'>Events <span class='badge'><img src='../images/emoji/1F383.svg' class='emojihalloween'></span></h1> <!-- TODO: Halloween Update -->
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
            $border = '2px dashed orange';
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

        if ($row['evtsViewed'] == '0') {
            $animation = "coolanimation";
            $updateNotifications = "UPDATE evts SET evtsViewed = 1 WHERE evtsUser='$username';";
            if (mysqli_query($conn, $updateNotifications)) {
                echo "<script>console.log('worked');</script>";
            }  else {
                echo 'not working';
            }
        } else {
            $animation = "none";
        }

        echo "
        
            <tr style='" . "background-color:" . $backgroundcolor . ";" . "color:" . $color . ";" . "animation-name:" . $animation . "; animation-duration: 2s; animation-iteration-count: infinite;'>
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
