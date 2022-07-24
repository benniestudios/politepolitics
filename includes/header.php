<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="9a0eba2a-9c51-4b4e-a9a3-dd791514aace" type="text/javascript" async></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Polite Politics</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/reset.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
  <script src="https://kit.fontawesome.com/e6e886a038.js" crossorigin="anonymous"></script> <!-- font awasome -->
  <script src="https://unpkg.com/@popperjs/core@2"></script>
</head>
<body onload="startTime()">

  <header>
    <center><a href="../index.php" id="logo"><img src="../images/logo/3.png"></a></center>
    <?php

    if (isset($_SESSION["useruid"])) {
      require_once '../includes/dbh.inc.php';
      $userid = $_SESSION["userid"];
      $useruid = $_SESSION["useruid"];
      $query = mysqli_query($conn, "SELECT * FROM users WHERE usersId='$userid';");
      $query1 = mysqli_query($conn, "SELECT * FROM items, production WHERE itemsUser='$useruid' AND productionUser='$useruid';");

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
        $smiley = '😀';
      } else {
        $smiley = '😭';
      }
      echo "<div class='resources-overview'><p id='money-view'><b><i class='fa-solid fa-dollar-sign'></i> Money: </b>" . number_format($row["usersMoney"]) . "<p id='moneyadd-view'> + $" . number_format($row["usersMoneyperhour"], 2) . " money/h</p></p>";
      echo "<p id='population-view'><b><i class='fa-solid fa-person'></i> Population: </b>" . number_format($row["usersPopulation"]). "<p>";
      echo "<p id='rp-view'><b><i class='fa-solid fa-book'></i> Research Points: </b>" . number_format($row["usersRP"]) . "<p>";
      echo "<p id='time-view'><b>⏰Time: </b><p>";
      echo "<p id='happiness-view'>" . $smiley . " " . $row["usersHappiness"] . "%<p></div>";
      

      }
      }
      while($row = mysqli_fetch_assoc($query1)) {

    echo "
        <table class='itemstableheader'>
          <tr><td><p>Food</p>" . number_format($row["itemsFood"]) . "<br><div class='rsprod'>+" . number_format($row['productionFood']) . "/h</div></td></tr>
          <tr><td><p>Coal</p>" . number_format($row["itemsCoal"]) . "<br><div class='rsprod'>+" . number_format($row['productionCoal']) . "/h</div></td></tr>
          <tr><td><p>Iron</p>" . number_format($row["itemsIron"]) . "<br><div class='rsprod'>+" . number_format($row['productionIron']) . "/h</div></td></tr>
          <tr><td><p>Oil</p>" . number_format($row["itemsOil"]) . "<br><div class='rsprod'>+" . number_format($row['productionOil']) . "/h</div></td></tr>
          <tr><td><p>Steel</p>" . number_format($row["itemsSteel"]) . "<br><div class='rsprod'>+" . number_format($row['productionSteel']) . "/h</div></td></tr>
          <tr><td><p>Uranium</p>" . number_format($row["itemsUranium"]) . "<br><div class='rsprod'>+" . number_format($row['productionUranium']) . "/h</div></td></tr>
        </table>";
    }
    }
    }
    ?>
    <div class="navbar">
      <center>
      <span style="font-size:30px;cursor:pointer" onclick="openNav()" class="gamemenu"><i class="fa-solid fa-bars"></i></span>
      </center>
    </div>
    <nav id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
      <ul>
        
        <li><a href="../index.php"><i class="fa-solid fa-house"></i> Home</a></li>
        <?php
          if (isset($_SESSION["useruid"])) {
            echo "<li><a href='" . 'https://politepolitics.benniestudios.com/'.$_SESSION['useruid'] . "'><i class='fa-solid fa-user'></i> Profile</a></li>";
            echo "<li><a href='../includes/logout.inc.php'><i class='fa-solid fa-right-from-bracket'></i> Logout</a></li>";
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
            echo "<li class='gamemenu' id='nation'><a href='../'><i class='fa-solid fa-landmark-flag'></i> Nation</a></li>";
            echo "<li class='gamemenu' id='cities'><a href='../cities/index.php'><i class='fa-solid fa-building'></i> Cities</a></li>";
            echo "<li class='gamemenu' id='banklink'><a href='../user/bank.php'><i class='fa-solid fa-piggy-bank'></i> Bank</a></li>";
            echo "<li class='gamemenu' id='daily'><a href='../user/daily.php'><i class='fa-solid fa-gift'></i> Daily</a></li>";
            echo "<li class='gamemenu' id='wars'><a href='../wars/index.php'><i class='fa-solid fa-circle-radiation'></i> Wars</a></li>";
            echo "<li class='gamemenu' id='options'><a href='../user/rewarded-ads.php'><i class='fa-solid fa-money-bill'></i> Rewarded Ads</a></li>";
            echo "<li class='gamemenu' id='options'><a href='../user/setup.php'><i class='fa-solid fa-screwdriver-wrench'></i> Setup</a></li>";
            echo "<br><center><li class='menulabel'>World</li></center><br>";
            echo "<li class='gamemenu' id='nations'><a href='../user/nations.php'><i class='fa-solid fa-earth-europe'></i> Nations</a></li>";
            echo "<li class='gamemenu' id='market'><a href='../market/index.php'><i class='fa-solid fa-shop'></i> Market</a></li>";
          }
          else {
            echo "<li><a href='../signup.php'>Sign Up</a></li>";
            echo "<li><a href='../login.php'>Login</a></li>";
            header("../");
          }
        ?>
      </ul>
        </div>
    </nav>
    <script>
function openNav() {
  document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}
</script>
  </header>



  <main>
