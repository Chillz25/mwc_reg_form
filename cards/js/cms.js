
$(document).ready(function () {

  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });

  $("#page-content-wrapper").addClass("load");

});


$(document).ready(function () {
	$( "#birthdate" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: '1940:2010'
    });
} );
