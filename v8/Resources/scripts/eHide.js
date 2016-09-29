$(window).scroll(function() {

    if ($(this).scrollTop()>0)
     {
        $('#topdownarrow').fadeOut();
     }
    else
     {
      $('#topdownarrow').fadeIn();
     }
 });