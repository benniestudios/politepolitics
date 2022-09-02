<?php
          include_once '../includes/header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $userid = $_SESSION["userid"];
    $username = $_SESSION["useruid"];
    $query = mysqli_query($conn, "SELECT * FROM users, cities, items WHERE usersId='$userid' AND citiesUid='$username' AND itemsUser='$username';");

    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    echo "";

    if(mysqli_num_rows($query) > 0){

    echo "
    <center>
    <div'>
    <h1 class='headergame' id='bank'>Sell Resources</h1>
        <form action='../includes/market.inc.php' class='headmainpage signup-form' method='post'>
            <label for='resource'>Select Resource: </label>
            <br>
            <select id='resource_select' name='resource'>
                <option value='food'>Food</option>
                <option value='coal'>Coal</option>
                <option value='iron'>Iron</option>
                <option value='oil'>Oil</option>
                <option value='steel'>Steel</option>
                <option value='uranium'>Uranium</option>
            </select>
            <br><br>
            <label for='amount'>Amount: </label>
            <br>
            <input id='amount' type='number' name='amount' min='1' max='1000000'>
            <br><br>
            <label for='price'>Price per unit: </label>
            <br>
            <input id='price' type='number' name='price' min='1' max='1000000'>
            <br><br>
            <input type='hidden' name='food' value='" . $row["itemsFood"] . "'>
            <input type='hidden' name='coal' value='" . $row["itemsCoal"] . "'>
            <input type='hidden' name='iron' value='" . $row["itemsIron"] . "'>
            <input type='hidden' name='oil' value='" . $row["itemsOil"] . "'>
            <input type='hidden' name='steel' value='" . $row["itemsSteel"] . "'>
            <input type='hidden' name='uranium' value='" . $row["itemsUranium"] . "'>
            <button type='submit' name='sell'>Sell</button>
        </form>
    </div>
    </center>";
    

    }else{

    header('location: index.php?error=somethingwentwrong');
    }
    ?>
</div>


<?php
          include_once '../includes/footer.php';
        ?>
