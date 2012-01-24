<?php
function get_sidebar_location(){
	return theme_option('sidebar_location');
}

function get_page_location(){
	$sidebar_location = theme_option('sidebar_location');
	$content_class;
	
	if ((is_front_page() && theme_option('sidebar_on_homepage')) || !is_front_page()) {
  	switch ( $sidebar_location) {  
  		case "left":  
  			$content_class = "position-right";
  			break;
  		case "right":
  			$content_class = "position-left";
  			break;
  		default:
  			$content_class = "position-full";
  	}
	}
	else {
	  $content_class = "position-full";
	} 
	
	
	return $content_class;
}

?>