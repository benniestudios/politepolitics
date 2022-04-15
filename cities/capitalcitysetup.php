<?php
    include_once 'header.php';
?>

<center>
    <form class="signup-form" action="../includes/capitalsetup.inc.php" method="post">
        <label class="setup-form">Citie Name: </label><input type="text" name="citiename" placeholder="Utopia" />
        <br />
        <label class="setup-form">Cost: $100,000</label>
        <br />
        <button type="submit" name="submit">Submit</button>
    </form>
</center>

<?php
    include_once 'footer.php';
?>