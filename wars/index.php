<?php
          include_once '../includes/header.php';
        ?>

<div class="game">
    <?php

    require_once '../includes/dbh.inc.php';
    $userid = $_SESSION["userid"];
    $index_num = 0;
    $query = mysqli_query($conn, "SELECT * FROM users WHERE usersId=$userid");

    if (!$query)
    {
    die('Error: ' . mysqli_error($conn));
    }

    if(mysqli_num_rows($query) > 0){
        $nations = array();
        $nation_name = array();
        $score = array();
    while($row = mysqli_fetch_assoc($query)) {
    if ($row["usersSetup"] === '1') {
        
        array_push($nations, $row["usersUid"]);
        array_push($nation_name, $row["usersNationName"]);
        array_push($score, number_format($row["usersTotalscore"]));
        $alliance_name = $row["usersAlliance"];
    }

    

    else {
    header('location: setup.php?error=notsetup');
    }
    }

    }else{

    header('location: setup.php?error=somethingwentwrong');
    }
    
    function array_key_lookup($array, $keys, $defaultValue)
{
    $value = $array;
    foreach ($keys as $key) {
        if (isset($value[$key])) {
            $value = $value[$key];
        } else {
            $value = $defaultValue;
            break;
        }
    }

    return $value;
}

    echo "
            <style type='text/css'>@import url('../css/map.css')</style>
            <center>
                <section class='map headergame'>
                    
                </section>
            </center>
        ";
    ?>
    
</div>
<script>
    $(document).ready(function(){
   for(var i = 0; i< 510; i++)
     $(".map").append("<div class='tile' id='"+i+"'><span>Tile "+i+"</span></div>");  
     
});

    const slider = document.querySelector(".map");
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener("mousedown", e => {
  isDown = true;
  slider.classList.add("active");
  startX = e.pageX - slider.offsetLeft;
  scrollLeft = slider.scrollLeft;
});
slider.addEventListener("mouseleave", () => {
  isDown = false;
  slider.classList.remove("active");
});
slider.addEventListener("mouseup", () => {
  isDown = false;
  slider.classList.remove("active");
});
slider.addEventListener("mousemove", e => {
  if (!isDown) return;
  e.preventDefault();
  const x = e.pageX - slider.offsetLeft;
  const walk = x - startX;
  slider.scrollLeft = scrollLeft - walk;
});
</script>

<?php
          include_once '../includes/footer.php';
        ?>
