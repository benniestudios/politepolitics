// Tax slider on bank page
var slider = document.getElementById("slider");
var output = document.getElementById("value");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}

// Time on user page
function startTime() {
  
  const today = new Date();
  let h = today.getUTCHours();
  let m = today.getUTCMinutes();
  let s = today.getUTCSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('time-view').innerHTML = "<img src='../images/emoji/1F551.svg' class='emoji'> Time: " + h + ':' + m + ':' + s;
  setTimeout(startTime, 1000);
}

function checkTime(i) {
  if (i < 10) {i = '0' + i};  // add zero in front of numbers < 10
  return i;
}

