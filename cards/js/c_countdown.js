
var x = setInterval(function() {

  var time_createddate     = "<?php echo $order['createddate']; ?>";
  var time_expirationdate  = "<?php echo $order['expirationdate']; ?>";

  var now = new Date().getTime();

  var distance = time_createddate - time_expirationdate;
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.querySelectorAll('.c_countdown').forEach(function(elem){
    elem.innerHTML = innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
  })

  if (distance < 0) {
    clearInterval(x);
    document.getElementById("c_countdown").innerHTML = "EXPIRED";
  }
}, 1000);
