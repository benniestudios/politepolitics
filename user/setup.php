<?php
    include_once 'header.php';
?>

<center>
    <form class="signup-form" action="../includes/setup.inc.php" method="post">
        <label class="setup-form">Nation name: </label><input type="text" name="nationname" placeholder="Utopia" />
        <br />
        <label class="setup-form" for="nationtype">What is the form of your government? </label>
        <select id="nationtype" name="nationtype" size="1">
            <option value="Democracy">Democracy</option>
            <option value="Dictatorship">Dictatorship</option>
            <option value="Monarchy">Monarchy</option>
        </select>
        <br />
        <button type="submit" name="submit">Submit</button>
    </form>
</center>

<?php
    include_once 'footer.php';
?>