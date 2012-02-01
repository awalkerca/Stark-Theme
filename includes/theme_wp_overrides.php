<?php
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' ); 
}

function enable_post_categories(){
  register_taxonomy_for_object_type('category','page');
}

function my_custom_dashboard_widgets() {
   global $wp_meta_boxes;

   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
   unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
   unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

   wp_add_dashboard_widget('custom_help_widget', 'Help and Support', 'custom_dashboard_help');
}

function custom_dashboard_help() {
   echo '<p>Welcome to your custom theme! Need help? Contact the developer <a href="http://www.awalker.ca.">here</a>.<a href="http://www.awalker.ca"></a></p>';
}

function my_admin_menu() {
     remove_menu_page('link-manager.php');
}

function my_admin_footer_text( $default_text ) {
     return '<span id="footer-thankyou">Theme developed by <a href="http://www.awalker.ca">Andrew Walker</a><span> | Powered by <a href="http://www.wordpress.org">WordPress</a>';
}

function add_body_color_scheme($classes){
  $classes[] = theme_option('colour_scheme'); 
  
  return $classes;
}


add_custom_background();


remove_action('wp_head', 'wp_generator');
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
add_action( 'admin_menu', 'my_admin_menu' );
add_action('admin_init','enable_post_categories');
add_filter( 'admin_footer_text', 'my_admin_footer_text' );
add_filter('login_errors', create_function('$a', "return 'Oops, Please try again.';"));
add_filter('body_class','add_body_color_scheme');
?>