
$(document).ready(function () {
  $("#menu-toggle").click(function() {
    $("#sidebar-menu").addClass("load");
    $("#menu-toggle").addClass("unload");
  });

  $("#menu-close").click(function() {
    $("#sidebar-menu").removeClass("load");
    $("#menu-toggle").removeClass("unload");
  });

  $("#page-content-wrapper").addClass("load");
  $("#menu-toggle").addClass("load");
});




