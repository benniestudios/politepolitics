<?php 
  include_once 'header.php';
?>

    <section class="signup-form">
      <center>
        <h2>Sign Up</h2>
        <div class="signup-form-form">
          <form action="includes/signup.inc.php" method="post">
              <input type="text" name="name" placeholder="Full name..."><br>
              <input type="text" name="email" placeholder="Email..."><br>
              <input type="text" name="uid" placeholder="Username..."><br>
              <input type="password" name="pwd" placeholder="Password..."><br>
              <input type="password" name="pwdrepeat" placeholder="Repeat password..."><br>
              <button type="submit" name="submit">Sign Up</button>
          </form>
        </div>
      

      <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
          echo "<p class='error'>Fill in all fields!</p>";
        }
        else if($_GET["error"] == "invaliduid") {
          echo "<p class='error'>Choose a proper username!</p>";
        }
        else if($_GET["error"] == "invalidemail") {
          echo "<p class='error'>Choose a proper email!</p>";
        }
        else if($_GET["error"] == "passwordsdontmatch") {
          echo "<p class='error'>Passwords don't match!</p>";
        }
        else if($_GET["error"] == "stmtfailed") {
          echo "<p class='error'>Something went wrong, please try again! Contact admin if this error keeps occuring.</p>";
        }
        else if($_GET["error"] == "usernametaken") {
          echo "<p class='error'>Username or email already taken!</p>";
        }
        else if($_GET["error"] == "none") {
          echo "<p class='successful'>You have succesfully signed up!</p>";
        }
      }
    ?>
    </center>
    </section>





<?php 
  include_once 'footer.php';
?>
