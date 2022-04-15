<?php
          include_once 'header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $userid = $_SESSION["userid"];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE usersId='$userid';");

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