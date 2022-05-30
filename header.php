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
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reset.css">
  <script type="text/javascript" src="javascript/script.js"></script>
  <script src="https://kit.fontawesome.com/e6e886a038.js" crossorigin="anonymous"></script> <!-- font awasome -->
</head>
<body>
  <header>
    <center><a href="index.php" id="logo"><img src="images/PP.png"></a></center>
    <nav>
      <ul class="navbar">
        <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
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
    </nav>
  </header>

  <main>
