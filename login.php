<?php 
  include_once 'header.php';
?>

    <section class="signup-form">
      <center>
        <h2>Login</h2>
        <div class="signup-form-form">
          <form action="includes/login.inc.php" method="post">
              <input type="text" name="uid" placeholder="Username/Email..."><br>
              <input type="password" name="pwd" placeholder="Password..."><br>
              <button type="submit" name="submit">Login</button>
          </form>
        </div>
        <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
          echo "<p class='error'>Fill in all fields!</p>";
        }
        else if($_GET["error"] == "wronglogin") {
          echo "<p class='error'>Choose a proper username!</p>";
        }
      }
    ?>
      </center>
    </section>

<?php 
  include_once 'footer.php';
?>
