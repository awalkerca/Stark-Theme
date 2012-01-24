
jQuery(document).ready(function($) {
  var duration = $('.featured_content').data('duration');
  $('.featured_content').tabs({
    fx: {opacity: 'toggle'}
  }).tabs("rotate",duration,true);
  $('.featured_content').hover(
    function(){
      $(this).tabs("rotate",0,true);
    },
    function(){
      $(this).tabs("rotate",duration,true);
    }
  );
  
});//end document ready