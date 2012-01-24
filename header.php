<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
    
    <?php
    /* 
     * Include this file when needing javascript + css into head of page
     */
    ?>
    <?php
    /*
    wp_register_style('reset', get_bloginfo('template_url') . '/css/reset.css');
    wp_enqueue_style( 'reset');

    wp_register_style('theme_style', get_bloginfo('stylesheet_url'),array('reset'));
    wp_enqueue_style( 'theme_style');
    */
    ?>

    <link type="text/css" href="<?php bloginfo('template_url');?>/assets/css/reset.css" rel="Stylesheet"  media="screen"/>
    <link type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" rel="Stylesheet" media="screen" />

    <!-- latest jQuery direct from google's CDN -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url');?>/assets/js/main.js"></script>
    
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
   	<?php
		  $colour_scheme = theme_option('colour_scheme'); 
	  ?>	
	
	<body class="<?= strtolower($colour_scheme); ?>">
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