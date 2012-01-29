<?php
/**
 * Template Name: 3 Widget Columns
 *
 * Selectable from a dropdown menu on the edit page screen.
 */
?>

<?php get_header(); ?>
  <div class="main_body <?= get_page_location() ?>">
    <div id="content" class="three_columns">
      <?php if (theme_option('content_slider_enabled') && is_front_page() ){$featured_content->display_content();} ?>
      <div class="column">
        <ul>
          <?php if(function_exists('dynamic_sidebar')&& dynamic_sidebar('Widget Page Column 1')) : else: ?>
            <li>                
            </li>
            <?php endif; //dynamic sidebar ?>
        </ul>
      </div>      
      <div class="column">
        <ul>
          <?php if(function_exists('dynamic_sidebar')&& dynamic_sidebar('Widget Page Column 2')) : else: ?>
            <li>           
            </li>
          <?php endif; //dynamic sidebar ?>
        </ul>
      </div>
      <div class="column">
        <ul>
          <?php if(function_exists('dynamic_sidebar')&& dynamic_sidebar('Widget Page Column 3')) : else: ?>
            <li>          
           </li>
          <?php endif; //dynamic sidebar ?>
        </ul>      
      </div>
    </div>
  </div>
<?php get_footer(); ?>
