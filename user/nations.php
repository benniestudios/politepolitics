<?php
          include_once '../includes/header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $userid = $_SESSION["userid"];
    $index_num = 0;
    $query = mysqli_query($conn, "SELECT * FROM users WHERE usersSetup=1 ORDER BY usersTotalscore desc");

    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) > 0){
        echo "
        <center>
            <table class='nationstable'>
                <h1 class='headergame' id='nationsheader'>Nations</h1>
                <tr>
                    <th id='index-num'>📊</th>
                    <th>Username</th>
                    <th>Nation</th>
                    <th>Population</th>
                    <th>Total Score</th>
                </tr>
            </table>
        </center>";
    while($row = mysqli_fetch_assoc($query)) {
    if ($row["usersSetup"] === '1') {
        $index_num += 1;
    echo "
    <center>
    <table class='nationstable'>
        <tr>
            <td id='index-num'>" . $index_num . "</td>
            <td><a id='nationlink' href='" . 'https://politepolitics.benniestudios.com/'.$row['usersUid'] . "'>" . $row["usersUid"]. "</a></td>
            <td>" . $row["usersNationName"]. "</td>
            <td>" . $row["usersPopulation"]. "</td>
            <td>" . number_format($row["usersTotalscore"]). "</td>
        </tr>


    </table>
    ";
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
