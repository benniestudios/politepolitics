<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SFNWW28HMD"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-SFNWW28HMD');
</script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Polite Politics</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../node_modules/izitoast/dist/css/iziToast.min.css">
  <script src="../node_modules/izitoast/dist/js/iziToast.min.js" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
  <script src="https://kit.fontawesome.com/e6e886a038.js" crossorigin="anonymous"></script> <!-- font awasome -->
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script type="module" defer>
  import { polyfillCountryFlagEmojis } from "https://cdn.skypack.dev/country-flag-emoji-polyfill";
  polyfillCountryFlagEmojis();
  </script>
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
      $evtsquery = mysqli_query($conn, "SELECT * FROM evts WHERE evtsUser='$useruid' AND evtsViewed = 0;");

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
      echo "<div class='resources-overview'><p id='money-view'><b><img src='../images/emoji/1F4B5.svg' class='emoji'/> <span>$" . number_format($row["usersMoney"]) . " <i class='fa-solid fa-caret-down'></i></span></b><p id='moneyadd-view'> $" . number_format($row["usersMoneyperhour"], 2) . " money/h</p></p>";
      echo "<p id='population-view'><b><img src='../images/emoji/1F46A.svg' class='emoji'> <span>" . number_format($row["usersPopulation"]). " <i class='fa-solid fa-caret-down'></i></span></b><p id='populationmax-view'> Max: " . number_format($row["usersPopulation"], 0) . "</p><p>";
      echo "<p id='rp-view'><b><img src='../images/emoji/1F52C.svg' class='emoji'></b>" . number_format($row["usersRP"]) . " <i class='fa-solid fa-caret-down'></i><p id='rpinfo-view'>Used for researching new technologies</p><p>";
      echo "<p id='time-view'><b><img src='../images/emoji/1F551.svg' class='emoji'></b><p>";
      echo "<p id='happiness-view'>" . $smiley . " " . $row["usersHappiness"] . "%<p>";
      echo "<p id='topbar'>a<p></div>";
      
      if ($row["weatherName"] == 'Clear') {
        $weatherImage = '../images/emoji/2600.svg';
        $backgroundcolor = 'lightyellow';
      } elseif ($row["weatherName"] == 'Clouds') {
        $weatherImage = '../images/emoji/2601.svg';
        $backgroundcolor = 'white';
      } elseif ($row["weatherName"] == 'Rain') {
        $weatherImage = '../images/emoji/1F327.svg';
        $backgroundcolor = '#add8e6';
      } elseif ($row["weatherName"] == 'Thunderstorm') {
        $weatherImage = '../images/emoji/26C8.svg';
        $backgroundcolor = 'lightgray';
      } elseif ($row["weatherName"] == 'Drizzle') {
        $weatherImage = '../images/emoji/1F327.svg';
        $backgroundcolor = 'lightblue';
      } elseif ($row["weatherName"] == 'Snow') {
        $weatherImage = '../images/emoji/1F328.svg';
        $backgroundcolor = 'white';
      } elseif ($row["weatherName"] == 'Mist') {
        $weatherImage = '../images/emoji/1F32B.svg';
        $backgroundcolor = 'lightgray';
      } elseif ($row["weatherName"] == 'Haze') {
        $weatherImage = '../images/emoji/1F32B.svg';
        $backgroundcolor = 'white';
      } elseif ($row["weatherName"] == 'Dust') {
        $weatherImage = '../images/emoji/1F32B.svg';
        $backgroundcolor = '#C2B280';
      } elseif ($row["weatherName"] == 'Fog') {
        $weatherImage = '../images/emoji/1F32B.svg';
        $backgroundcolor = 'white';
      } elseif ($row["weatherName"] == 'Sand') {
        $weatherImage = '../images/emoji/1F32B.svg';
        $backgroundcolor = '#C2B280';
      } elseif ($row["weatherName"] == 'Ash') {
        $weatherImage = '../images/emoji/1F32B.svg';
        $backgroundcolor = 'lightgray';
      } elseif ($row["weatherName"] == 'Squall') {
        $weatherImage = '../images/emoji/1F32B.svg';
        $backgroundcolor = 'white';
      } elseif ($row["weatherName"] == 'Tornado') {
        $weatherImage = '../images/emoji/1F32A.svg';
        $backgroundcolor = 'red';
      } else {
        $weatherImage = '../images/emoji/2600.svg';
        $backgroundcolor = 'white';
      }
      
      echo "<div class='scrollingtxt marquee'>
              <div class='marquee__content'>
                <h3 class='list-inline'>
                  <span>
                    <img src='" . $weatherImage . "'>
                    Weather:
                    <span class='weatherinfo' style='background-color:" . $backgroundcolor . ";'>
                       " . $row["weatherDesc"] . " 
                    </span>
                  </span>
                  <span>
                    <img src='../images/emoji/1F321.svg'>
                      Temperature: 
                      <span class='weatherinfo'>
                        " . $row["weatherTemp"] . "°C 
                      </span>
                  </span>

                  <span>
                    <img src='" . $weatherImage . "'>
                    Weather:
                    <span class='weatherinfo' style='background-color:" . $backgroundcolor . ";'>
                       " . $row["weatherDesc"] . " 
                    </span>
                  </span>
                  <span>
                    <img src='../images/emoji/1F321.svg'>
                      Temperature: 
                      <span class='weatherinfo'>
                        " . $row["weatherTemp"] . "°C 
                      </span>
                  </span>

                  <span>
                    <img src='" . $weatherImage . "'>
                    Weather:
                    <span class='weatherinfo' style='background-color:" . $backgroundcolor . ";'>
                       " . $row["weatherDesc"] . " 
                    </span>
                  </span>
                  <span>
                    <img src='../images/emoji/1F321.svg'>
                      Temperature: 
                      <span class='weatherinfo'>
                        " . $row["weatherTemp"] . "°C 
                      </span>
                  </span>

                  <span>
                    <img src='" . $weatherImage . "'>
                    Weather:
                    <span class='weatherinfo' style='background-color:" . $backgroundcolor . ";'>
                       " . $row["weatherDesc"] . " 
                    </span>
                  </span>
                  <span>
                    <img src='../images/emoji/1F321.svg'>
                      Temperature: 
                      <span class='weatherinfo'>
                        " . $row["weatherTemp"] . "°C 
                      </span>
                  </span>
                  <span>
                    <img src='" . $weatherImage . "'>
                    Weather:
                    <span class='weatherinfo' style='background-color:" . $backgroundcolor . ";'>
                       " . $row["weatherDesc"] . " 
                    </span>
                  </span>
                  <span>
                    <img src='../images/emoji/1F321.svg'>
                      Temperature: 
                      <span class='weatherinfo'>
                        " . $row["weatherTemp"] . "°C 
                      </span>
                  </span>
                  <span>
                    <img src='" . $weatherImage . "'>
                    Weather:
                    <span class='weatherinfo' style='background-color:" . $backgroundcolor . ";'>
                       " . $row["weatherDesc"] . " 
                    </span>
                  </span>
                  <span>
                    <img src='../images/emoji/1F321.svg'>
                      Temperature: 
                      <span class='weatherinfo'>
                        " . $row["weatherTemp"] . "°C 
                      </span>
                  </span>
                </h3>
                
              </div>
            </div>
            
            
            ";
    

      if ($row["usersWeatherShow"] == 1) {
        $setWeatherShow = "UPDATE users SET usersWeatherShow = 0 WHERE usersId='$userid';";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $setWeatherShow)) {
            header("location: ../user/setup.php?error=stmtfailed");
            exit();
        }

        if (mysqli_query($conn, $setWeatherShow)) {
            echo "<script>console.log('worked');</>";
        }  else {
            echo 'not working';
        }

      }


      }
      }
      while($row = mysqli_fetch_assoc($query1)) {

    echo "
        <table class='itemstableheader'>
          <tr><td><p>Food</p>" . number_format($row["itemsFood"]) . "<br><div class='rsprod'>+" . number_format($row['productionFood']) . "/h</div></td></tr>
          <tr><td><p>Wood</p>" . number_format($row["itemsFood"]) . "<br><div class='rsprod'>+" . number_format($row['productionFood']) . "/h</div></td></tr>
          <tr><td><p>Coal</p>" . number_format($row["itemsCoal"]) . "<br><div class='rsprod'>+" . number_format($row['productionCoal']) . "/h</div></td></tr>
          <tr><td><p>Iron</p>" . number_format($row["itemsIron"]) . "<br><div class='rsprod'>+" . number_format($row['productionIron']) . "/h</div></td></tr>
          <tr><td><p>Oil</p>" . number_format($row["itemsOil"]) . "<br><div class='rsprod'>+" . number_format($row['productionOil']) . "/h</div></td></tr>
          <tr><td><p>Steel</p>" . number_format($row["itemsSteel"]) . "<br><div class='rsprod'>+" . number_format($row['productionSteel']) . "/h</div></td></tr>
          <tr><td><p>Uranium</p>" . number_format($row["itemsUranium"]) . "<br><div class='rsprod'>+" . number_format($row['productionUranium']) . "/h</div></td></tr>
        </table>";
    }
    }
    }

    if (!$evtsquery)
      {
        die('Error: ' . mysqli_error($conn));
      }

    if(mysqli_num_rows($evtsquery) > 0){

      while($row = mysqli_fetch_assoc($evtsquery)) {
        if ($row['evtsViewed'] == '0') {
          $color = "green";
          $notification = "<span class='badge'>!</span>";
          $animation = "coolanimation";
        } else {
          $animation = "none";
          $color = "darkred";
        }
      }
    } else {
      $animation = "none";
      $color = "darkred";
      $notification = "";
    }
    ?>
    <div class="navbar">
      <center>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()" class="gamemenubutton"><i class="fa-solid fa-bars"></i></span>
      </center>
    </div>
    <?php echo "
    <div class='eventbutton'>
      <a id='eventbutton' href='../user/events.php' style='background-color:" . $color . ";animation-name:" . $animation . "; animation-duration: 2s; animation-iteration-count: infinite;'><i class='fa-solid fa-bell'></i>" . $notification . "</a>
    </div>";
    ?>

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
            echo "<li class='gamemenu' id='options'><a href='../user/rewarded-ads.php'><i class='fa-solid fa-money-bill'></i> Ads</a></li>";
            echo "<li class='gamemenu' id='options'><a href='../user/setup.php'><i class='fa-solid fa-screwdriver-wrench'></i> Setup</a></li>";

            echo "<br><center><li class='menulabel'>Alliance</li></center><br>";
            echo "<li class='gamemenu' id='cities'><a href='../alliance/index.php'><i class='fa-solid fa-users'></i> Info</a></li>";
            echo "<li class='gamemenu' id='banklink'><a href='#'><i class='fa-solid fa-building-columns'></i> Bank</a></li>";
            echo "<li class='gamemenu' id='daily'><a href='#'><i class='fa-solid fa-globe'></i> Alliances</a></li>";

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
  if (window.innerWidth < 1000) {
    document.getElementById("myNav").style.height = "100%";
  }
  
}

function closeNav() {
  if (window.innerWidth < 1000) {
    document.getElementById("myNav").style.height = "0%";
}
}
</script>
  </header>



  <main>
