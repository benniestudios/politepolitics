<?php
include_once '../includes/header.php';
?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $userid = $_SESSION["userid"];
    $index_num = 0;
    $query = mysqli_query($conn, "SELECT * FROM users, alliance WHERE usersAlliance=allianceName");

    if (!$query) {
        die('Error: ' . mysqli_error($conn));
    }

    if (mysqli_num_rows($query) > 0) {
        $nations = array();
        $nation_name = array();
        $score = array();
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row["usersSetup"] === '1') {

                array_push($nations, $row["usersUid"]);
                array_push($nation_name, $row["usersNationName"]);
                array_push($score, number_format($row["usersTotalscore"]));
                $alliance_name = $row["usersAlliance"];
                $alliance_leader = $row["allianceLeader"];
                $alliance_flag = $row["allianceImage"];
                $alliance_description = $row["allianceInfo"];

                $alliance_tax_money = $row["allianceTaxMoney"];
                $alliance_tax_food = $row["allianceTaxFood"];
                $alliance_tax_coal = $row["allianceTaxCoal"];
                $alliance_tax_iron = $row["allianceTaxIron"];
                $alliance_tax_oil = $row["allianceTaxOil"];
                $alliance_tax_steel = $row["allianceTaxSteel"];
                $alliance_tax_uranium = $row["allianceTaxUranium"];
            } else {
                header('location: setup.php?error=notsetup');
            }
        }

    } else {

        header('location: setup.php?error=somethingwentwrong');
    }

    function array_key_lookup($array, $keys, $defaultValue)
    {
        $value = $array;
        foreach ($keys as $key) {
            if (isset($value[$key])) {
                $value = $value[$key];
            } else {
                $value = $defaultValue;
                break;
            }
        }

        return $value;
    }

    echo "
            <style type='text/css'>@import url('../css/alliance.css')</style>
            <center>
            <section class='animated-grid'>
                <div class='card'><div class='vertical-center' id='allianceflag'>" . $alliance_flag . "</div></div>
                <div class='card'><div class='vertical-center alliance-name'>" . $alliance_name . "</div></div>
                <div class='card'><div class='vertical-center'>" . $alliance_leader . "</div></div>
                <div class='card'>
                    <div class='main-alliance'>
                        Menu
                        <br>
                        <ul>
                            <li><a href='#'>Overview</a></li>
                            <li><a href='#'>Bank</a></li>
                            <li><a href='#'>Tax Overview</a></li>
                            <li><a href='#'>Manage</a></li>
                        </ul>
                    </div>
                </div>
                <div class='card'><div class='main-alliance'>Money/Resources in the Alliance Bank (only visible to leader/banker role)</div></div>
                <div class='card'><div class='main-alliance' id='taxrates'>Tax Rates<br>
                    <br><p style='color:lightgreen;'>Money</p>" . $alliance_tax_money . "
                    <br><br><p>Food</p>" . $alliance_tax_food . "
                    <br><p>Coal</p>" . $alliance_tax_coal . "
                    <br><p>Iron</p>" . $alliance_tax_iron . "
                    <br><p>Oil</p>" . $alliance_tax_oil . "
                    <br><p>Steel</p>" . $alliance_tax_steel . "
                    <br><p>Uranium</p>" . $alliance_tax_uranium . "
                </div>
                </div>
                <div class='card'><div class='main-alliance description-text'><p id='description'>Description</p><br><br>" . $alliance_description . "</div></div>
                <div class='card'><div class='main-alliance'><table class='alliance-table'>
                <h1 id='bank'>Nations</h1>
                <tr>
                    <th>Username</th>
                    <th>Nation</th>
                    <th>Score</th>
                </tr>
                <tr><td>" . array_key_lookup($nations, [0], NULL) . "</td><td>" . array_key_lookup($nation_name, [0], NULL) . "</td><td>" . array_key_lookup($score, [0], NULL) . "</td></tr>
                <tr><td>" . array_key_lookup($nations, [1], NULL) . "</td><td>" . array_key_lookup($nation_name, [1], NULL) . "</td><td>" . array_key_lookup($score, [1], NULL) . "</td></tr>
                <tr><td>" . array_key_lookup($nations, [2], NULL) . "</td><td>" . array_key_lookup($nation_name, [2], NULL) . "</td><td>" . array_key_lookup($score, [2], NULL) . "</td></tr>
                <tr><td>" . array_key_lookup($nations, [3], NULL) . "</td><td>" . array_key_lookup($nation_name, [3], NULL) . "</td><td>" . array_key_lookup($score, [3], NULL) . "</td></tr>
                <tr><td>" . array_key_lookup($nations, [4], NULL) . "</td><td>" . array_key_lookup($nation_name, [4], NULL) . "</td><td>" . array_key_lookup($score, [4], NULL) . "</td></tr>
                <tr><td>" . array_key_lookup($nations, [5], NULL) . "</td><td>" . array_key_lookup($nation_name, [5], NULL) . "</td><td>" . array_key_lookup($score, [5], NULL) . "</td></tr>
                <tr><td>" . array_key_lookup($nations, [6], NULL) . "</td><td>" . array_key_lookup($nation_name, [6], NULL) . "</td><td>" . array_key_lookup($score, [6], NULL) . "</td></tr>
                <tr><td>" . array_key_lookup($nations, [7], NULL) . "</td><td>" . array_key_lookup($nation_name, [7], NULL) . "</td><td>" . array_key_lookup($score, [7], NULL) . "</td></tr>
                <tr><td>" . array_key_lookup($nations, [8], NULL) . "</td><td>" . array_key_lookup($nation_name, [8], NULL) . "</td><td>" . array_key_lookup($score, [8], NULL) . "</td></tr>
                <tr><td>" . array_key_lookup($nations, [9], NULL) . "</td><td>" . array_key_lookup($nation_name, [9], NULL) . "</td><td>" . array_key_lookup($score, [9], NULL) . "</td></tr>
                </table></div></div>
            </section>
            </center>
        ";
    ?>

</div>


<?php
include_once '../includes/footer.php';
?>
