<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php language_attributes(); ?>>
  <head>
    
    <?php
      wp_enqueue_style( 'reset', get_bloginfo('template_url') . '/assets/css/reset.css');
      wp_enqueue_style('theme_style', get_bloginfo('stylesheet_url'),'reset');
      
      wp_enqueue_script('jquery');
      wp_enqueue_script('theme_script', get_bloginfo('template_url') . '/assets/js/main.js','jquery');
    ?>
    
    <?php wp_head(); ?>
		<?php
			$favicon = theme_option('favicon');
			if (file_exists($favicon)){
		?>
		        <link rel="shortcut icon" href="<?= $favicon ?>"/>
		<?php
			}	//file exists
		?>

    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>" charset="<?php bloginfo('charset'); ?>" />
    <meta name="author" content="Andrew Walker" />
    <title>
      <?php bloginfo('name');?>
      <?php wp_title(); ?>
    </title>
  </head>
		
	<body <?php body_class($class); ?>>
    <div id="container">
      <div id="main">         
        <div id="header">
          <h1><a href="<?php bloginfo('url'); ?>"><span><?php bloginfo('name');?></span></a></h1>
          <h2><span><?php bloginfo('description');?></span></h2>
          <?php if (theme_option('facebook_username') || theme_option('twitter_username')) { ?>
            <ul id="social_menu">          
              <?php if ($fb = theme_option('facebook_username')) { ?>
                <li><a href="http://www.facebook.com/<?= $fb ?>"><span>Facebook</span></a></li>
              <?php } ?>              
              <?php if ($twtr = theme_option('twitter_username')) { ?>
                <li><a href="http://www.twitter.com/<?= $twtr ?>"><span>Twitter</span></a></li>
              <?php } ?>
            </ul>            
          <?php } ?>

          <?php wp_nav_menu(
            array(
              'theme_location' => 'primary-menu',
              'container_id'  => 'header_main_menu',
              'link_before'   => '<span>',
              'link_after'    => '</span>',
              'depth'         => 2
            )); ?>
        </div>
			<?php
			if ((is_front_page() && theme_option('sidebar_on_homepage')) || !is_front_page()) {
				get_sidebar();	//so that variables are available within sidebar
			} 
			?>