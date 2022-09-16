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
  <meta name="description" content="Polite Politics is a free text-based nation simulation game. Create your own nation now!">
  <meta name="keywords" content="polite politics, nation simulation">
  <title>Polite Politics</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reset.css">
  <script type="text/javascript" src="javascript/script.js"></script>
  <script type="text/javascript" src="javascript/main.ts"></script>
  <script src="https://kit.fontawesome.com/e6e886a038.js" crossorigin="anonymous"></script> <!-- font awasome -->
</head>
<body>
  <header>
    <center><a href="index.php" id="logo"><img src="images/logo/3.png"></a></center>
    <center>
      <div class="navbar">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()" class="gamemenu"><i class="fa-solid fa-bars"></i></span>
      </div>
    </center>
    <nav class="overlay" id="myNav" loading="lazy">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
      <ul>
        <li><a href="index.php"><i class="fa-solid fa-house"></i> Home</a></li>
        <?php
          if (isset($_SESSION["useruid"])) {
            echo "<li><a href='user/profile.php'>Profile</a></li>";
            echo "<li><a href='includes/logout.inc.php'>Logout</a></li>";
            header('location: /user');
          }
          else {
            echo "<li><a href='signup.php'>Sign Up</a></li>";
            echo "<li><a href='login.php'>Login</a></li>";
          }
        ?>
      </ul>
        </div>
    </nav>

    <script>
function openNav() {
  document.getElementById("myNav").style.height = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.height = "0%";
}
</script>

  </header>

  <main>
