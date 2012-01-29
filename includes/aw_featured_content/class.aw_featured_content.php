<?php

  /* 
 Plugin Name: Featured Content
 Plugin URI: http://www.awalker.ca/featured_content 
 Description: Plugin for placing a "featured content" section onto a page, based on a category
 Author: A. Walker
 Version: 1.0 
 Author URI: http://www.awalker.ca 
 */

  class AW_FeaturedContent{
    
    protected $plugin_name;
    protected $plugin_short_name;
    protected $short_code;

    function __construct(){
      $this->plugin_name = "aw_featured_content";
      $this->plugin_short_name = "aw_fc";
      $this->short_code = "featured-content";
      add_action('get_header', array(&$this,'featured_content_scripts'));
      add_shortcode($this->short_code,array(&$this,'shortcode'));
            
    }
    
    public function shortcode(){
      return $this->render();
    }
    
    public function display_content(){
      echo $this->shortcode();
    }
    
    public function featured_content_scripts(){
      $file_dir = get_template_directory_uri() . '/includes/aw_featured_content/';
            
      wp_enqueue_style('content_slider_style',$file_dir . 'aw_featured_content.css');
      
      wp_enqueue_script('jquery-ui-tabs');
      
      wp_enqueue_script('featured_content_loader',$file_dir . 'featured_content.js');
    }
    
    private function get_slider_duration(){
       $num = theme_option('content_slider_duration');
        if (is_numeric($num)){
          return $num * 1000;
        }else{
          return 5 * 1000;
        }  
    }
    private function render(){
      $content = '';          //all content
      $content_list = '';     //content menu list
      $content_body =''; //content body list
      
      $category = theme_option('content_slider_category');
      $number_of_posts = theme_option('content_slider_num_items');
      
      $args = array('showposts' => $number_of_posts, 'cat' => $category, 'post_type'=> 'any', 'order' => 'DESC');
      switch(theme_option('content_slider_menu_location')){
        case 'left':
          $menu_class = 'position-left';
          $content_class ='position-right';          
          break;
        case 'right':
        
        default:
          $menu_class = 'position-right';
          $content_class = 'position-left';
      }
           
      $content .= '<div class="featured_content" data-duration="' . $this->get_slider_duration() . '" style="height:' . theme_option('content_slider_height') . 'px;">';
      $content_list .= '<ol class="content_summary_list ui-tabs-nav '. $menu_class . '" style="height:' . theme_option('content_slider_height') .'px;">';
      $fc_query = new WP_Query($args);
      $ctr = 0;
      
      $link_location = theme_option('content_slider_call_to_action');
      
      while($fc_query->have_posts()){
        $fc_query->the_post();
        $post_id = $fc_query->post_ID;
        $featured_post_id = "slide_" . $fc_query->current_post;
        $content_body .= '<div class="featured_post ui-tabs-panel '. $content_class . '" id="' . $featured_post_id . '">';      
        $content_body .= '<div class="featured_post_content">';
        $title = get_the_title($post_id);
        $item_height = ((100 / $fc_query->post_count));
        $content_list .= '<li class="list_item ui-tabs-nav-item " style="height:'. $item_height .'%;">';
        $content_list .= '<a href="#'. $featured_post_id .'"><span>' . $title .'</span></a>';
        $content_list .= '</li>';
        if (theme_option('content_slider_content') == 'content'){          
          $desc = get_the_content($post_id);          
        }else{
          $desc = get_the_excerpt($post_id);          
        }
        $content_body .= '<h2>';
        if ($link_location == 'title'){
          $content_body .= '<a href="' . get_permalink($post_id) . '" title="'. $title . '" class="call_to_action">' . $title .'</a>';
        }else{
          $content_body .= $title;
        }
        $content_body .= '</h2>';
        $content_body .= '<p class="description">'. $desc . '</p>';
        if ($link_location == 'link'){          
          $content_body .= '<a href="' . get_permalink($post_id) . '" title="'. $title . '" class="call_to_action">Read More</a>';
        }
        $content_body .= '</div>';
        $content_body .= '</div>'; //featured_post
      $ctr ++;
      }
      wp_reset_postdata();
      $content_list .= '</ol>';
      $content .= $content_list;
      $content .= $content_body;
      $content .= '</div>';
      return $content;
    }
        
  }
  
  $featured_content = new AW_FeaturedContent();
  
?>