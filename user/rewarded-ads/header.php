<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Polite Politics</title>
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/reset.css">
  <script src="https://kit.fontawesome.com/e6e886a038.js" crossorigin="anonymous"></script> <!-- font awasome -->


</head>
<body onload="startTime()">

  <header>

    <!-- Logo -->
    <center>
        <a href="index.php" id="logo">
            <img src="../../images/PP.png">
        </a>
    </center>

    <?php

    if (isset($_SESSION["useruid"])) {
      require_once '../../includes/dbh.inc.php';
      $userid = $_SESSION["userid"];
      $useruid = $_SESSION["useruid"];
      $query = mysqli_query($conn, "SELECT * FROM users WHERE usersId='$userid';"); # Selects users table
      $query1 = mysqli_query($conn, "SELECT * FROM items WHERE itemsUser='$useruid';"); # Selects items table

      if (!$query)
      {
        die('Error: ' . mysqli_error($conn));
      }

      if(mysqli_num_rows($query) > 0){



      while($row = mysqli_fetch_assoc($query)) {
          if ($row["usersSetup"] === '1') {

              # Changes smiley depending on happiness
              if ($row['usersHappiness'] >= 80) {
                $smiley = '☺️';
              } elseif ($row['usersHappiness'] >= 50) {
                $smiley = '😟';
              } else {
                $smiley = '😭';
              }

              # Displays resources, time, happiness, population etc.
              echo "<div class='resources-overview'><p id='money-view'><b>💲Money: </b>" . number_format($row["usersMoney"]) . "<p id='moneyadd-view'> + $" . number_format($row["usersTaxes"]*0.001*$row["usersPopulation"]/5+$row['usersHappiness'], 2) . "/h</p><p>";
              echo "<p id='population-view'><b>👥Population: </b>" . number_format($row["usersPopulation"]). "<p>";
              echo "<p id='rp-view'><b>🔬Research Points: </b>" . number_format($row["usersRP"]) . "<p>";
              echo "<p id='time-view'><b>⏰Time: </b><p>";
              echo "<p id='happiness-view'>" . $smiley . "<b>Population Happiness: </b>" . $row["usersHappiness"] . "%<p></div>";


          }
      }
      while($row = mysqli_fetch_assoc($query1)) {

    # Table (right) of all the resources
    echo "
        <table class='itemstableheader'>
            <tr><td><p>Food</p>" . $row["itemsFood"]. "</td></tr>
            <tr><td><p>Iron</p>" . $row["itemsIron"]. "</td></tr>
            <tr><td><p>Coal</p>" . $row["itemsCoal"]. "</td></tr>
            <tr><td><p>Aluminium</p>" . $row["itemsAluminium"] . "</td></tr>
            <tr><td><p>Oil</p>" . $row["itemsOil"] . "</td></tr>
            <tr><td><p>Steel</p>" . $row["itemsSteel"] . "</td></tr>
            <tr><td><p>Uranium</p>" . $row["itemsUranium"] . "</td></tr>
        </table>";
    }
    }
    }


    ?>

    <nav>
      <ul class="navbar">

        <li>
            <a href="../../index.php" class='tooltip'>
                <i class="fa-solid fa-house"></i>
                <span class="tooltiptext">Home</span>
            </a>
        </li>

        <?php
          if (isset($_SESSION["useruid"])) {
            echo "<li><a href='" . 'https://politepolitics.benniestudios.com/'.$_SESSION['useruid'] . "' class='tooltip'><i class='fa-solid fa-user'></i><span class='tooltiptext'>Profile</span></a></li>";
            echo "<li><a href='../../includes/logout.inc.php' class='tooltip'><i class='fa-solid fa-right-from-bracket'></i><span class='tooltiptext'>Logout</span></a></li>";

          }
          else {
            echo "<li><a href='../../signup.php'>Sign Up</a></li>";
            echo "<li><a href='../../login.php'>Login</a></li>";
            header("../");
          }
        ?>
        <?php
          if (isset($_SESSION["useruid"])) {
            echo "<br><center><li class='menulabel'>Nation</li></center><br>";
            echo "<li class='gamemenu'><a href='./' class='tooltip'><i class='fa-solid fa-landmark-flag'></i><span class='tooltiptext'>Nation</span></a></li>";
            echo "<li class='gamemenu'><a href='../cities/index.php'  class='tooltip'><i class='fa-solid fa-building'></i><span class='tooltiptext'>Cities</span></a></li>";
            echo "<li class='gamemenu'><a href='bank.php' class='tooltip'><i class='fa-solid fa-piggy-bank'></i><span class='tooltiptext'>Bank</span></a></li>";
            echo "<li class='gamemenu'><a href='daily.php' class='tooltip'><i class='fa-solid fa-gift'></i><span class='tooltiptext'>Daily Reward</span></a></li>";
            echo "<li class='gamemenu'><a href='setup.php' class='tooltip'><i class='fa-solid fa-screwdriver-wrench'></i><span class='tooltiptext'>Options</span></a></li>";
            echo "<br><center><li class='menulabel'>World</li></center><br>";
            echo "<li class='gamemenu'><a href='nations.php' class='tooltip'><i class='fa-solid fa-earth-europe'></i><span class='tooltiptext'>Nations</span></a></li>";

          }
          else {
            echo "<li><a href='../../signup.php'>Sign Up</a></li>";
            echo "<li><a href='../../login.php'>Login</a></li>";
            header("../");
          }
        ?>
      </ul>
    </nav>
  </header>



  <main>
