//Search Function
  $(document).ready(function () {
      $("#searchBox").keyup(function () {
          var query = $("#searchBox").val();
          if (query.length > 1) {
              $.ajax(
                  {
                      url: 'search.ajax.php',
                      method: 'POST',
                      data: {
                          search: 1,
                          q: query
                      },
                      success: function (data) {
                          $("#response").html(data);
                          $("#response").addClass("visible");
                      },
                      dataType: 'text'
                  }
              );
          }
      });

      // $(document).on('focusout', '.search-bar', function () {
      //     $("#response").html("");
      // });

      $(document).on('click touchstart', '.li-search', function () {
          var country = $(this).text();
          $("#searchBox").val(country);
          setTimeout(function(){
              $("#response").html("");
              $("#response").removeClass("visible");
            },300);
      });

      $(document).on('focusout', '.search-bar', function () {
          setTimeout(function(){
              $("#response").removeClass("visible");
       },100);
      });


  });
