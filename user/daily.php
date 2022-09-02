<?php
          include_once '../includes/header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    require_once '../includes/functions.inc.php';
    $userid = $_SESSION["userid"];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE usersId='$userid';");

    echo "<center><h1 class='dailyreward'>Succesfully claimed $5000!</h1></center>";
    echo "<center><p class='dailyreward'>Come back tomorrow to claim again!</p></center>";

    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)) {
    if ($row["usersSetup"] === '1') {
        if ($row['usersDaily'] === '1') {
            moremoney($conn, $userid);
            echo "
<script>
iziToast.show({
  id: null, 
  class: '',
  title: 'Success!',
  titleColor: '',
  titleSize: '',
  titleLineHeight: '',
  message: 'Successfully claimed your daily reward!',
  messageColor: '',
  messageSize: '',
  messageLineHeight: '',
  backgroundColor: '#00FF00',
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
        } else {
            echo "
<script>
iziToast.show({
  id: null, 
  class: '',
  title: 'Success!',
  titleColor: '',
  titleSize: '',
  titleLineHeight: '',
  message: 'Reward already claimed!',
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
    }
    }

    }else{

    header('location: setup.php?error=somethingwentwrong');
    }
    ?>
</div>

<script src="https://unpkg.com/vue@3"></script>
<script src="../javascript/script.js"></script>

<?php
          include_once '../includes/footer.php';
        ?>
