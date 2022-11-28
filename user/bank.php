<?php
          include_once '../includes/header.php';
?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $useruid = $_SESSION["useruid"];
    $userid = $_SESSION["userid"];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE usersId='$userid';");
    $query1 = mysqli_query($conn, "SELECT * FROM items WHERE itemsUser='$useruid';");
    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)) {
    if ($row["usersSetup"] === '1') {

    $standardpercentage = $row['usersTaxes'];

    echo "
    <center></center>
    <center>
    <table class='headergame'>
        <h1 class='headergame' id='bank'>Bank <span class='badge'><img src='../images/emoji/1F3E6.svg' class='emojihalloween'></span></h1> <!-- TODO: Emoji Update -->
        <tr><th>Account Name</th><td>" . $row["usersUid"]. "</td></tr>
        <tr><th>Nation</th><td>" . $row["usersNationName"]. "</td></tr>
        <tr><th>Bank Balance</th><td>$" . number_format($row["usersMoney"], 2). "</td></tr>


    </table>
    <table class='headergame'>
        <h1 class='headergame' id='bank'>Taxes</h1>
        <tr><th>Current tax rate</th><td>" . $row["usersTaxes"]. "%</td></tr>
        <tr><th>Money per hour</th><td>$" . number_format($row["usersMoneyperhour"], 2) . "/h</td></tr>




    </table>

    <form action='../includes/tax.inc.php' method='post' class='taxrate'>
        <b><label for='changetaxrate'>Change tax rate:</label></b><br>
        <input type='hidden' name='userid' value='$userid'><br>
        <input id='slider' class='slider' type='range' name='changetaxrate' min='5' max='100' value='$standardpercentage' step='5'><br><br>
        <p>Tax rate: <span id='value'></span>%</p>
        <button type='submit' name='submit'>Submit</button><br>
        <label id='happinesswarning'>⚠️ this affects your happiness when higher than 20%!</label>
    </form>
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
