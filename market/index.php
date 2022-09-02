<?php
          include_once '../includes/header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $userid = $_SESSION["userid"];
    $username = $_SESSION["useruid"];
    $query = mysqli_query($conn, "SELECT * FROM users, cities, items, market WHERE usersId='$userid' AND citiesUid='$username' AND itemsUser='$username' ORDER BY marketId DESC;");

    if ($_GET['market'] == 'success') {
        echo "
<script>
iziToast.show({
  id: null, 
  class: '',
  title: 'Market',
  titleColor: '',
  titleSize: '',
  titleLineHeight: '',
  message: 'Successfully bought resources!',
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

    if ($_GET['market'] == 'error') {
        echo "
<script>
iziToast.show({
  id: null, 
  class: '',
  title: 'Market',
  titleColor: '',
  titleSize: '',
  titleLineHeight: '',
  message: 'Something went wrong! Please try again.',
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
  image: '../images/emoji/274C.svg',
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


    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    echo "
    
    <center>
        <table class='nationstable'>
            <h1 class='headergame' id='bank'>Market</h1>
            <tr>
                    <a id='marketbutton' href='create.php'><i class='fa-solid fa-circle-plus'></i></a>
                    <a id='marketbutton' href='view.php'><i class='fa-solid fa-warehouse'></i></a>
                </tr>
            <tr>
                    <th>User</th>
                    <th>Item</th>
                    <th>Price per Unit</th>
                    <th>Quantity</th>
                    <th class='markettd'></th>
            </tr>
        <table>
    </center>
    
    ";

    if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)) {
    if ($row["usersSetup"] === '1') {
    echo "
    <center>
        <table class='nationstable'>
            <tr>
                <form action='../includes/marketsell.inc.php' method='POST'>
                    <td><input type='hidden' name='user' value='" . $row["marketUser"] . "'>" . $row["marketUser"]. "</td>
                    <td><input type='hidden' name='item' value='" . $row["marketItem"] . "'>" . $row["marketItem"]. "</td>
                    <td><input type='hidden' name='price' value='" . $row["marketPrice"] . "'>" . $row["marketPrice"]. "</td>
                    <td><input type='hidden' name='quantity' value='" . $row["marketQuantity"] . "'>" . $row["marketQuantity"]. "</td>
                    <input type='hidden' name='money' value='" . $row["usersMoney"] . "'>
                    <td class='markettd'>
                        <input type='number' name='amount'>
                        <button class='marketBuy'>Buy</button>
                    </td>
                </form>
            </tr>
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
    ?>
</div>


<?php
          include_once '../includes/footer.php';
        ?>
