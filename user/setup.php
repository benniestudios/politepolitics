<?php
    include_once '../includes/header.php';
?>

<center>
    <h1 class="headergame" id="bank">Setup</h1>
    <form class="signup-form" action="../includes/setup.inc.php" method="post">
        <label class="setup-form" id="setuplabel">Nation name</label>
        <br />
        <input type="text" name="nationname" placeholder="Utopia" value="<?php echo $_SESSION['nation']; ?>" />
        <br />
        <br />
        <label class="setup-form" for="nationtype" id="setuplabel">Form of Government </label>
        <div class="custom-select">
            <select id="nationtype" name="nationtype" size="1">
                <option value="0">Select a Form of Government...</option>

                <?php
                
                if ($_SESSION['nationType'] == 'Democracy') {
                  echo "<option selected value='Democracy'>Democracy</option>";
                } else {
                  echo "<option value='Democracy'>Democracy</option>";
                }

                if ($_SESSION['nationType'] == 'Dictatorship') {
                  echo "<option selected value='Dictatorship'>Dictatorship</option>";
                } else {
                  echo "<option value='Dictatorship'>Dictatorship</option>";
                }

                if ($_SESSION['nationType'] == 'Monarchy') {
                  echo "<option selected value='Monarchy'>Monarchy</option>";
                } else {
                  echo "<option value='Monarchy'>Monarchy</option>";
                }

                ?>
            </select>
        </div>
        <br />
        <label class="setup-form" for="color" id="setuplabel">Color Trade Bloc</label>
        <div class="custom-select">
            <select id="nationtype" name="color" size="1">
            <option value="0">Select a Color...</option>
            <?php
                if ($_SESSION['color'] == 'red') {
                  echo "<option selected value='red'>Red</option>";
                } else {
                  echo "<option value='red'>Red</option>";
                }

                if ($_SESSION['color'] == 'green') {
                  echo "<option selected value='green'>Green</option>";
                } else {
                  echo "<option value='green'>Green</option>";
                }

                if ($_SESSION['color'] == 'blue') {
                  echo "<option selected value='blue'>Blue</option>";
                } else {
                  echo "<option value='blue'>Blue</option>";
                }

                if ($_SESSION['color'] == 'orange') {
                  echo "<option selected value='orange'>Orange</option>";
                } else {
                  echo "<option value='orange'>Orange</option>";
                }

                if ($_SESSION['color'] == 'yellow') {
                  echo "<option selected value='yellow'>Yellow</option>";
                } else {
                  echo "<option value='yellow'>Yellow</option>";
                }

                if ($_SESSION['color'] == 'black') {
                  echo "<option selected value='black'>Black</option>";
                } else {
                  echo "<option value='black'>Black</option>";
                }

                if ($_SESSION['color'] == 'gray') {
                  echo "<option selected value='gray'>Gray</option>";
                } else {
                  echo "<option value='gray'>Gray</option>";
                }

                if ($_SESSION['color'] == 'pink') {
                  echo "<option selected value='pink'>Pink</option>";
                } else {
                  echo "<option value='pink'>Pink</option>";
                }

                if ($_SESSION['color'] == 'purple') {
                  echo "<option selected value='purple'>Purple</option>";
                } else {
                  echo "<option value='purple'>Purple</option>";
                }

              ?>
            </select>
        </div>
        <br />
        <br />
        <label class="setup-form" for="flag" id="setuplabel">Flag</label>
        <div class="custom-select">
            <select id="flag" name="flag" size="1">
                <option value="0">Select a Flag...</option>
                <option value="&#127462&#127464">&#127462&#127464</option>
                <option value="&#127462&#127465">&#127462&#127465</option>
                <option value="&#127462&#127466">&#127462&#127466</option>
                <option value="&#127462&#127467">&#127462&#127467</option>
                <option value="&#127462&#127468">&#127462&#127468</option>
                <option value="&#127462&#127470">&#127462&#127470</option>
                <option value="&#127462&#127473">&#127462&#127473</option>
                <option value="&#127462&#127474">&#127462&#127474</option>
                <option value="&#127462&#127476">&#127462&#127476</option>
                <option value="&#127462&#127478">&#127462&#127478</option>
                <option value="&#127462&#127479">&#127462&#127479</option>
                <option value="&#127462&#127480">&#127462&#127480</option>
                <option value="&#127462&#127481">&#127462&#127481</option>
                <option value="&#127462&#127482">&#127462&#127482</option>
                <option value="&#127462&#127484">&#127462&#127484</option>
                <option value="&#127462&#127485">&#127462&#127485</option>
                <option value="&#127462&#127487">&#127462&#127487</option>
                <option value="&#127463&#127462">&#127463&#127462</option>
                <option value="&#127463&#127463">&#127463&#127463</option>
                <option value="&#127463&#127465">&#127463&#127465</option>
                <option value="&#127463&#127466">&#127463&#127466</option>


            </select>
        </div>
        <br />
        <button type="submit" name="submit">Submit</button>
    </form>
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</center>

<script>
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);

for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[1];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>

<?php
    include_once '../includes/footer.php';
?>
