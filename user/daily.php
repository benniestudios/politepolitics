<?php
          include_once 'header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    require_once '../includes/functions.inc.php';
    $userid = $_SESSION["userid"];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE usersId='$userid';");

    echo "<center><h1 class='dailyreward'>Succesfully claimed $5000!</h1></center>";
    echo "<center><p class='dailyreward'>Come back tomorrow to claim again!</p></center>";

    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)) {
    if ($row["usersSetup"] === '1') {
        if ($row['usersDaily'] === '1') {
            moremoney($conn, $userid);
        }
    }
    }

    }else{

    header('location: setup.php?error=somethingwentwrong');
    }
    ?>
</div>

<script src="https://unpkg.com/vue@3"></script>
<script src="../javascript/script.js"></script>

<?php
          include_once 'footer.php';
        ?>