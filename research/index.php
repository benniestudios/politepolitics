<?php
          include_once '../includes/header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $userid = $_SESSION["userid"];
    $username = $_SESSION["useruid"];
    
    $query = mysqli_query($conn, "SELECT * FROM users, cities, evts WHERE usersId='$userid' AND citiesUid='$username' AND evtsUser='$username' ORDER BY evtsId DESC LIMIT 15;");

    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) >= 0){

    while($row = mysqli_fetch_assoc($query)) {
    if ($row["usersSetup"] === '1') {

        
        
    }
    else {
    header('location: events.php?error=notsetup');
    }
    }

    }else{

    header('location: events.php?error=somethingwentwrong');
    }

    // header
    echo "
        <style type='text/css'>@import url('../css/research.css')</style>
        <h1 class='headergame' id='bank'>Research <span class='badge'><img src='../images/emoji/1F50D.svg' class='emojihalloween'></span></h1> <!-- TODO: Halloween Update -->
        ";

    echo "
        <div class='headergame'>
            <center>
                <div id='research-toptxt'>
                    <p>Research new technologies and ensure a well-developed nation.You can earn research points by going on missions. However, these missions must be completed successfully.</p>
                </div>
            </center>
            <br>
            <center>
                <div class='research'>
                <img src='../images/emoji/23EC.svg' style='width=20px;height:20px;'>
                  <div class='research-circle' id='rmil1' aria-describedby='tooltip'>
                    <img src='../images/emoji/1F396.svg'>
                    <p class='research-info' id='trmil1' role='tooltip'>Military I<br><span style='font-size:9px;font-weight:normal;'>Cost: 5 RP</span></p>
                  </div>
                  <div class='research-circle' id='rmil2'>
                    <img src='../images/emoji/1F396.svg'>
                    <p class='research-info' id='trmil2' role='tooltip'>Military II<br><span style='font-size:9px;font-weight:normal;'>Cost: 10 RP</span></p>
                  </div>
                  <div class='research-circle' id='rmil3'>
                    <img src='../images/emoji/1F396.svg'>
                    <p class='research-info' id='trmil3' role='tooltip'>Military III<br><span style='font-size:9px;font-weight:normal;'>Cost: 20 RP</span></p>
                  </div>



                    <div class='research-circle' id='r1' aria-describedby='tooltip'>
                        <img src='../images/emoji/1F3A3.svg'>
                        <p class='research-info' id='tr1' role='tooltip'>Fishery<br><span style='font-size:9px;font-weight:normal;'>Cost: 1 RP</span></p>
                    </div>
                    <img src='../images/emoji/2199.svg' style='width=20px;height:20px;'>
                    <img src='../images/emoji/2198.svg' style='width=20px;height:20px;'>
                    <br>
                    <div class='research-circle' id='r2'>
                        <img src='../images/emoji/1F34E.svg'>
                        <p class='research-info' id='tr2' role='tooltip'>On a Diet<br><span style='font-size:9px;font-weight:normal;'>Cost: 2 RP</span></p>
                    </div>
                    <div class='research-circle' id='r3'>
                        <img src='../images/emoji/1F3DE.svg'>
                        <p class='research-info' id='tr3' role='tooltip'>Biome II<br><span style='font-size:9px;font-weight:normal;'>Cost: 2 RP</span></p>
                    </div>
                    <br>
                    <img src='../images/emoji/2199.svg' style='width=20px;height:20px;'>
                    <img src='../images/emoji/2198.svg' style='width=20px;height:20px;margin-right:12px;'>

                    <img src='../images/emoji/2199.svg' style='width=20px;height:20px;margin-left:12px;'>
                    <img src='../images/emoji/2198.svg' style='width=20px;height:20px;'>
                    <br>
                    <div class='research-circle' id='r4'>
                        <img src='../images/emoji/2600.svg'>
                        <p class='research-info' id='tr4' role='tooltip'>Under Control<br><span style='font-size:9px;font-weight:normal;'>Cost: 3 RP</span></p>
                    </div>
                    <div class='research-circle' id='r5'>
                        <img src='../images/emoji/1F42E.svg'>
                        <p class='research-info' id='tr5' role='tooltip'>Moo<br><span style='font-size:9px;font-weight:normal;'>Cost: 3 RP</span></p>
                    </div>
                    <div class='research-circle' id='r6'>
                        <img src='../images/emoji/1F332.svg'>
                        <p class='research-info' id='tr6' role='tooltip'>Chop Down the Trees!<br><span style='font-size:9px;font-weight:normal;'>Cost: 3 RP</span></p>
                    </div>



                    
                    
                </div>
            </center>
        </div>

        <script src='https://unpkg.com/@popperjs/core@2'></script>
        <script>
        const r1 = document.querySelector('#r1');
        const tr1 = document.querySelector('#tr1');
        Popper.createPopper(r1, tr1, {
          placement: 'right',
        });

        const r2 = document.querySelector('#r2');
        const tr2 = document.querySelector('#tr2');
        Popper.createPopper(r2, tr2, {
          placement: 'left',
        });

        const r3 = document.querySelector('#r3');
        const tr3 = document.querySelector('#tr3');
        Popper.createPopper(r3, tr3, {
          placement: 'right',
        });

        const r4 = document.querySelector('#r4');
        const tr4 = document.querySelector('#tr4');
        Popper.createPopper(r4, tr4, {
          placement: 'left',
        });

        const r5 = document.querySelector('#r5');
        const tr5 = document.querySelector('#tr5');
        Popper.createPopper(r5, tr5, {
          placement: 'bottom',
        });

        const r6 = document.querySelector('#r6');
        const tr6 = document.querySelector('#tr6');
        Popper.createPopper(r6, tr6, {
          placement: 'right',
        });

        const rmil1 = document.querySelector('#rmil1');
        const trmil1 = document.querySelector('#trmil1');
        Popper.createPopper(rmil1, trmil1, {
          placement: 'left',
        });

        const rmil2 = document.querySelector('#rmil2');
        const trmil2 = document.querySelector('#trmil2');
        Popper.createPopper(rmil2, trmil2, {
          placement: 'left',
        });

        const rmil3 = document.querySelector('#rmil3');
        const trmil3 = document.querySelector('#trmil3');
        Popper.createPopper(rmil3, trmil3, {
          placement: 'left',
        });

        </script>
    ";

    ?>

</div>


<?php
          include_once '../includes/footer.php';
        ?>
