<?php
          include_once '../includes/header.php';
        ?>

<div class="game">
    <center><button type="button" id="playButton">Watch Video</button></center>  <!--Create a button to initiate the video loading -->
    <script type="text/javascript" src="https://cdn.applixir.com/applixir.sdk3.0m.js"></script>   <!-- Applixir SDK -->
    <div id="applixir_vanishing_div" hidden>
        <iframe id="applixir_parent" allow="autoplay"></iframe>
    </div>

    <script type="application/javascript">

        var useruid = "<?php echo $useruid; ?>"
        function adStatusCallback(status) {                  // Status Callback Method
            console.log('Ad Status: ' + status);
        }

        var options = {                                     // Video Ad Options
             zoneId: 4730,
             accountId: 6056,                               // Required field for RMS
             gameId: 6902,                                  // Required field for RMS
             adStatusCb: adStatusCallback,
             userId: useruid,
             fallback: 1,                 // Required field for RMS
        };
        playBtn = document.getElementById("playButton");
        playBtn.onclick = function () {
                     invokeApplixirVideoUnit(options);     // Invoke Video ad
       }
    </script>
</div>


<?php
          include_once '../includes/header.php';
        ?>
