<?php
          include_once '../includes/header.php';
?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $username = $_SESSION["useruid"];
    $userid = $_SESSION["userid"];
    $query = mysqli_query($conn, "SELECT * FROM users, buildings, cities, items, production WHERE usersUid = buildingsUser = citiesUid = itemsUser = productionUser GROUP BY usersId;");
    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) > 0){

        echo "
        <table class='admintable'>
            <h1 class='headergame' id='bank'>Administration Dashboard</h1>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Nation</th>
                <th>Money</th>
                <th>Population</th>
            </tr>
            </table>
            ";

    while($row = mysqli_fetch_assoc($query)) {
    if ($username === 'Bennie') {

    echo "
<div class='admintablescroll'>
<table class='admintable'>
        <tr>
            <td>" . $row["usersId"]. "</td>
            <td>" . $row["usersName"]. "</td>
            <td>" . $row["usersUid"]. "</td>
            <td>" . $row["usersNationName"]. "</td>
            <td>" . number_format($row["usersMoney"]) . "</td>
            <td>" . number_format($row["usersPopulation"]) . "</td>
            <td>" . number_format($row["usersPopulation"]) . "</td>
            <td>" . number_format($row["usersPopulation"]) . "</td>
            <td>" . number_format($row["usersPopulation"]) . "</td>
            <td>" . number_format($row["usersPopulation"]) . "</td>

            <td>" . number_format($row["usersPopulation"]) . "</td>
            <td>" . number_format($row["usersPopulation"]) . "</td>
            <td>" . number_format($row["usersPopulation"]) . "</td>
            <td>" . number_format($row["usersPopulation"]) . "</td>
            <td>" . number_format($row["usersPopulation"]) . "</td>
            <td>" . number_format($row["usersPopulation"]) . "</td>

        </tr>


    </table>
    </div>
    ";
    }
    else {
    header('location: setup.php?error=notsetup');
    }
    }

    } else{

    header('location: setup.php?error=somethingwentwrong');
    }
    ?>
</div>

<?php
          include_once '../includes/footer.php';
        ?>
