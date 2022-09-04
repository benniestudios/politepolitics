<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SFNWW28HMD"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-SFNWW28HMD');
</script>
    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="9a0eba2a-9c51-4b4e-a9a3-dd791514aace" type="text/javascript" async></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Polite Politics</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../node_modules/izitoast/dist/css/iziToast.min.css">
  <script src="../node_modules/izitoast/dist/js/iziToast.min.js" type="text/javascript"></script>
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
      $query = mysqli_query($conn, "SELECT * FROM users, weather WHERE usersId='$userid';");
      $query1 = mysqli_query($conn, "SELECT * FROM items, production WHERE itemsUser='$useruid' AND productionUser='$useruid';");

      if (!$query)
      {
        die('Error: ' . mysqli_error($conn));
      }

      if(mysqli_num_rows($query) > 0){

      while($row = mysqli_fetch_assoc($query)) {
      if ($row["usersSetup"] === '1') {
      if ($row['usersHappiness'] >= 80) {
        $smiley = "<img src='../images/emoji/1F604.svg' class='emoji'>";
      } elseif ($row['usersHappiness'] >= 50) {
        $smiley = "<img src='../images/emoji/1F610.svg' class='emoji'>";
      } else {
        $smiley = "<img src='../images/emoji/1F621.svg' class='emoji'>";
        echo "
<script>
iziToast.show({
  id: null, 
  class: '',
  title: 'Hey!',
  titleColor: '',
  titleSize: '',
  titleLineHeight: '',
  message: 'Your population is unhappy! You should consider making some improvements.',
  messageColor: '',
  messageSize: '',
  messageLineHeight: '',
  backgroundColor: '#8b0000',
  theme: 'dark', // dark
  color: '#ffffff', // blue, red, green, yellow
  icon: '',
  iconText: '',
  iconColor: '',
  iconUrl: '',
  image: '../images/emoji/1F621.svg',
  imageWidth: 50,
  maxWidth: null,
  zindex: null,
  layout: 1,
  balloon: false,
  close: false,
  closeOnEscape: true,
  closeOnClick: true,
  displayMode: 0, // once, replace
  position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
  target: '',
  targetFirst: true,
  timeout: 5000,
  rtl: false,
  animateInside: true,
  drag: true,
  pauseOnHover: true,
  resetOnHover: false,
  progressBar: true,
  progressBarColor: '#000000',
  progressBarEasing: 'linear',
  overlay: true,
  overlayClose: true,
  overlayColor: 'rgba(50, 0, 0, 0.4)',
  transitionIn: 'bounceInDown',
  transitionOut: 'fadeOutUp',
  transitionInMobile: 'fadeInUp',
  transitionOutMobile: 'fadeOutDown',
  buttons: {},
  inputs: {},
  onOpening: function () {},
  onOpened: function () {},
  onClosing: function () {},
  onClosed: function () {}
});
</script>
";
      }
      echo "<div class='resources-overview'><p id='money-view'><b><img src='../images/emoji/1F4B5.svg' class='emoji'/> <span>Money: " . number_format($row["usersMoney"]) . "</span></b><p id='moneyadd-view'> + $" . number_format($row["usersMoneyperhour"], 2) . " money/h</p></p>";
      echo "<p id='population-view'><b><img src='../images/emoji/1F46A.svg' class='emoji'> <span>Population: " . number_format($row["usersPopulation"]). "</span></b><p>";
      echo "<p id='rp-view'><b><img src='../images/emoji/1F52C.svg' class='emoji'> Research Points: </b>" . number_format($row["usersRP"]) . "<p>";
      echo "<p id='time-view'><b><img src='../images/emoji/1F551.svg' class='emoji'> Time: </b><p>";
      echo "<p id='happiness-view'>" . $smiley . " " . $row["usersHappiness"] . "%<p></div>";
      
      if ($row["weatherShow"] == 1) {
        $setWeatherShow = "UPDATE weather SET weatherShow = 0;";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $setWeatherShow)) {
            header("location: ../user/setup.php?error=stmtfailed");
            exit();
        }

        if (mysqli_query($conn, $setWeatherShow)) {
            echo "<script>console.log('worked');</script>";
        }  else {
            echo 'not working';
        }

        echo "
<script>
iziToast.show({
  id: null, 
  class: '',
  title: '" . ucwords($row["weatherDesc"]) . "',
  titleColor: '',
  titleSize: '',
  titleLineHeight: '',
  message: ' " . $row["weatherName"] . " " . $row["weatherTemp"] . "°C',
  messageColor: '',
  messageSize: '',
  messageLineHeight: '',
  backgroundColor: '#add8e6',
  theme: 'light', // dark
  color: '#ffffff', // blue, red, green, yellow
  icon: '',
  iconText: '',
  iconColor: '',
  iconUrl: '',
  image: '../images/emoji/2600.svg',
  imageWidth: 50,
  maxWidth: null,
  zindex: null,
  layout: 1,
  balloon: false,
  close: false,
  closeOnEscape: true,
  closeOnClick: true,
  displayMode: 0, // once, replace
  position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
  target: '',
  targetFirst: true,
  timeout: 5000,
  rtl: false,
  animateInside: true,
  drag: true,
  pauseOnHover: true,
  resetOnHover: false,
  progressBar: true,
  progressBarColor: '#000000',
  progressBarEasing: 'linear',
  overlay: true,
  overlayClose: true,
  overlayColor: 'rgba(50, 0, 0, 0.4)',
  transitionIn: 'bounceInDown',
  transitionOut: 'fadeOutUp',
  transitionInMobile: 'fadeInUp',
  transitionOutMobile: 'fadeOutDown',
  buttons: {},
  inputs: {},
  onOpening: function () {},
  onOpened: function () {},
  onClosing: function () {},
  onClosed: function () {}
});
</script>
";
      }


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
