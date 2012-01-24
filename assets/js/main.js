jQuery(document).ready(function($){
  $('#header_main_menu ul>li>a').hover(function(){
      submenu = $(this).parent().find('.sub-menu');
      $(submenu).show();
      $(this).parent().hover( 
        function(){        
          $(this).addClass('sub_hover')
        },
        function(){
          $(this).removeClass('sub_hover')
          $(this).parent().find('.sub-menu').hide() 
        }
      )  
    });
});
