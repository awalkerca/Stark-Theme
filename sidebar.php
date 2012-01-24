<?php
$sidebar_location = theme_option('sidebar_location');
$sidebar_class;
switch ( $sidebar_location) {  
	case "left":  
		$sidebar_class = "position-left";
		break;
	case "right":
		$sidebar_class = "position-right";
		break;
}
?>
<?php
if ($sidebar_location != "none"){
?>
<div class="sidebar <?=$sidebar_class ?>">
    <ul>
        <?php if(function_exists('dynamic_sidebar')&& dynamic_sidebar('Top Sidebar')) : else: ?>
        <li id="search">
            <?php include(TEMPLATEPATH . '/searchform.php'); ?>
        </li>
        <li id="calendar">
            <h2>Calendar</h2>
            <?php get_calendar(); ?>
        </li>
        <?php wp_list_pages('depth=3&title_li=<h2>Pages</h2>'); ?>
        <li>
            <h2>Categories</h2>
            <ul>
                <?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?>
            </ul>
        </li>
         <li>
             <h2>Archives</h2>
				<ul>
                <?php wp_get_archives('type=monthly'); ?>
				</ul>
         </li>
         <?php get_links_list(); ?>
        <li id="meta-list">
            <h2>Meta</h2>
			<ul>
            <?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <?php wp_meta(); ?>
			</ul>
        </li>
        <?php endif; //dynamic sidebar ?>
    </ul>
    
    <?php if ($ad = theme_option('sidebar_ad1')){ ?>
          <div class="ad rectangle" id="sidebar_ad1">
            <?= $ad ?>
          </div>        
        <?php }?>
    <?php if ($ad = theme_option('sidebar_ad2')){ ?>
      <div class="ad rectangle" id="sidebar_ad2">
        <?= $ad ?>
      </div>        
    <?php }?>
    
    <ul>
      <?php if(function_exists('dynamic_sidebar')&& dynamic_sidebar('Bottom Sidebar')) : else: ?>
        <li>
             <h2>Archives</h2>
             <ul>
              <?php wp_get_archives('type=monthly'); ?>
            </ul>
         </li>
        <?php endif; //dynamic sidebar ?>
    </ul>
      
    <?php if ($ad = theme_option('sidebar_ad3')){ ?>
          <div class="ad rectangle" id="sidebar_ad3">
            <?= $ad ?>
          </div>        
        <?php }?>
    <?php if ($ad = theme_option('sidebar_ad4')){ ?>
      <div class="ad rectangle" id="sidebar_ad4">
        <?= $ad ?>
      </div>        
    <?php }?>

</div>
<?php	
}
?>