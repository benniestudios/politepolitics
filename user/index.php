<?php
          include_once '../includes/header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $userid = $_SESSION["userid"];
    $username = $_SESSION["useruid"];
    $query = mysqli_query($conn, "SELECT * FROM users, cities WHERE usersId='$userid' AND citiesUid='$username';");

    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)) {
    if ($row["usersSetup"] === '1') {
    echo "
    <center>
        <table class='headergame'>
            <h1 class='headergame' id='bank'>Nation</h1>
            <tr><th><img src='../images/emoji/E183.svg' class='emojilarge'> Leader name</th><td>" . $row["usersUid"]. "</td></tr>
            <tr><th><img src='../images/emoji/1F30D.svg' class='emojilarge'> Nation</th><td>" . $row["usersFlag"] . $row["usersNationName"]. "</td></tr>
            <tr><th><img src='../images/emoji/1F3DB.svg' class='emojilarge'> Form of government</th><td>" . $row["usersNationType"]. "</td></tr>
            <tr><th><img src='../images/emoji/1F332.svg' class='emojilarge'> Biome 1</th><td>" . $row["usersBiome"] . "</td></tr>
            <tr><th><img src='../images/emoji/1F333.svg' class='emojilarge'> Biome 2</th><td>" . $row["usersBiome2"] . "</td></tr>
            <tr><th><img src='../images/emoji/1FA99.svg' class='emojilarge'> Tax Percentage</th><td>" . $row["usersTaxes"]. "%</td></tr>
            <tr><th><img src='../images/emoji/1F604.svg' class='emojilarge'> Happiness</th><td>" . $row["usersHappiness"]. "%</td></tr>
            <tr><th><img src='../images/emoji/1F3C5.svg' class='emojilarge'> Score</th><td>" . number_format($row["usersTotalscore"]). "</td></tr>
            <tr><th style='background-color:white; border: none;'></th><td style='background-color:white;border: none;'></td></tr>
            <tr><th><img src='../images/emoji/1F3D9.svg' class='emojilarge'> Capital City</th><td>" . $row["citiesCapital"]. "</td></tr>
            <tr><th><img src='../images/emoji/1F46A.svg' class='emojilarge'> Population</th><td>" . number_format($row["usersPopulation"]) . "</td></tr>
        </table>


    </center>";
    }
    else {
    header('location: setup.php?error=notsetup');
    }
    }

    }else{

    header('location: setup.php?error=somethingwentwrong');
    }

    if ($_GET['login'] == 'success') {
        echo "
<script>
iziToast.show({
  id: null, 
  class: '',
  title: 'Welcome Back!',
  titleColor: '',
  titleSize: '',
  titleLineHeight: '',
  message: 'Successfully logged in!',
  messageColor: '',
  messageSize: '',
  messageLineHeight: '',
  backgroundColor: '#006400',
  theme: 'dark', // dark
  color: '#ffffff', // blue, red, green, yellow
  icon: '',
  iconText: '',
  iconColor: '',
  iconUrl: '',
  image: '../images/emoji/2714.svg',
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
  overlay: false,
  overlayClose: false,
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
    ?>
</div>


<?php
          include_once '../includes/footer.php';
        ?>
