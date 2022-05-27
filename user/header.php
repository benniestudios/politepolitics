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
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/reset.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script src="https://kit.fontawesome.com/e6e886a038.js" crossorigin="anonymous"></script> <!-- font awasome -->
</head>
<body onload="startTime()">

  <header>
    <center><a href="../index.php" id="logo"><img src="../images/PP.png"></a></center>
    <?php

    if (isset($_SESSION["useruid"])) {
      require_once '../includes/dbh.inc.php';
      $userid = $_SESSION["userid"];
      $useruid = $_SESSION["useruid"];
      $query = mysqli_query($conn, "SELECT * FROM users WHERE usersId='$userid';");
      $query1 = mysqli_query($conn, "SELECT * FROM items WHERE itemsUser='$useruid';");

      if (!$query)
      {
        die('Error: ' . mysqli_error($conn));
      }

      if(mysqli_num_rows($query) > 0){



      while($row = mysqli_fetch_assoc($query)) {
      if ($row["usersSetup"] === '1') {
      if ($row['usersHappiness'] >= 80) {
        $smiley = '☺️';
      } elseif ($row['usersHappiness'] >= 50) {
        $smiley = '😟';
      } else {
        $smiley = '😭';
      }
      echo "<div class='resources-overview'><p id='money-view'><b>💲Money: </b>" . number_format($row["usersMoney"]) . "<p id='moneyadd-view'> + $" . number_format($row["usersMoneyperhour"], 2) . "/h</p><p>";
      echo "<p id='population-view'><b>👥Population: </b>" . number_format($row["usersPopulation"]). "<p>";
      echo "<p id='rp-view'><b>🔬Research Points: </b>" . number_format($row["usersRP"]) . "<p>";
      echo "<p id='time-view'><b>⏰Time: </b><p>";
      echo "<p id='happiness-view'>" . $smiley . "<b>Population Happiness: </b>" . $row["usersHappiness"] . "%<p></div>";


      }
      }
      while($row = mysqli_fetch_assoc($query1)) {

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
        <li><a href="../index.php"><i class="fa-solid fa-house"></i></a></li>
        <?php
          if (isset($_SESSION["useruid"])) {
            echo "<li><a href='" . 'https://politepolitics.benniestudios.com/'.$_SESSION['useruid'] . "'><i class='fa-solid fa-user'></i></a></li>";
            echo "<li><a href='../includes/logout.inc.php'><i class='fa-solid fa-right-from-bracket'></i></a></li>";

          }
          else {
            echo "<li><a href='../signup.php'>Sign Up</a></li>";
            echo "<li><a href='../login.php'>Login</a></li>";
            header("../");
          }
        ?>
        <?php
          if (isset($_SESSION["useruid"])) {
            echo "<br><center><li class='menulabel'>Nation</li></center><br>";
            echo "<li class='gamemenu'><a href='../'><i class='fa-solid fa-landmark-flag'></i></a></li>";
            echo "<li class='gamemenu'><a href='../cities/index.php'><i class='fa-solid fa-building'></i></a></li>";
            echo "<li class='gamemenu'><a href='../user/bank.php'><i class='fa-solid fa-piggy-bank'></i></a></li>";
            echo "<li class='gamemenu'><a href='../user/daily.php'><i class='fa-solid fa-gift'></i></i></a></li>";
            echo "<li class='gamemenu'><a href='../user/setup.php'><i class='fa-solid fa-screwdriver-wrench'></i></a></li>";
            echo "<br><center><li class='menulabel'>World</li></center><br>";
            echo "<li class='gamemenu'><a href='../user/nations.php'><i class='fa-solid fa-earth-europe'></i></a></li>";

          }
          else {
            echo "<li><a href='../signup.php'>Sign Up</a></li>";
            echo "<li><a href='../login.php'>Login</a></li>";
            header("../");
          }
        ?>
      </ul>
    </nav>
  </header>



  <main>
