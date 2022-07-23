<?php
          include_once '../includes/header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $userid = $_SESSION["userid"];
    $username = $_SESSION["useruid"];
    $query = mysqli_query($conn, "SELECT * FROM users, cities, items, market WHERE usersId='$userid' AND citiesUid='$username' AND itemsUser='$username';");

    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    echo "
    
    <center>
        <table class='nationstable'>
            <h1 class='headergame' id='bank'>Market</h1>
            <tr>
                    <a id='marketbutton' href='create.php'><i class='fa-solid fa-circle-plus'></i></a>
                    <a id='marketbutton' href='view.php'><i class='fa-solid fa-warehouse'></i></a>
                </tr>
            <tr>
                <th>User</th>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        <table>
    </center>
    
    ";

    if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)) {
    if ($row["usersSetup"] === '1') {
    echo "
    <center>
        <table class='nationstable'>
            <tr>
                <td>" . $row["marketUser"]. "</td>
                <td>" . $row["marketItem"]. "</td>
                <td>" . $row["marketPrice"]. "</td>
                <td>" . $row["marketQuantity"]. "</td>
            </tr>
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
          include_once '../includes/footer.php';
        ?>
