<?php
function register_my_sidebars(){
  if ( function_exists('register_sidebar') ) {
      register_sidebar(array('name' => 'Top Sidebar'));
      register_sidebar(array('name' => 'Bottom Sidebar'));
      register_sidebar(array('name' => 'Footer'));
      register_sidebar(array('name' => 'Widget Page Column 1'));
      register_sidebar(array('name' => 'Widget Page Column 2'));
      register_sidebar(array('name' => 'Widget Page Column 3'));
  }  
}

add_action('widgets_init','register_my_sidebars');
?>