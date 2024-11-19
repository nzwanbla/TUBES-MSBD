
$(document).ready(function () {
    
    $('#nav-tabs').children('li').first().children('a').addClass('active')
        .next().addClass('is-open').show();
        
    $('#nav-tabs').on('click', 'li > a', function() {
        
      if (!$(this).hasClass('active')) {

        $('#nav-tabs .is-open').removeClass('is-open').hide();
        $(this).next().toggleClass('is-open').toggle();
          
        $('#nav-tabs').find('.active').removeClass('active');
        $(this).addClass('active');
      } else {
        $('#nav-tabs .is-open').not($(this).next()).removeClass('is-open').hide();
      }
   });
});
