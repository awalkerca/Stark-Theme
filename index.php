<?php get_header(); ?>
  <div class="page <?= get_page_location() ?>">
    <div id="content">
      <?php if (theme_option('content_slider_enabled') && is_front_page() ){$featured_content->display_content();} ?>
      <?php get_template_part('loop','index'); ?>
    </div>
  </div>
<?php get_footer(); ?>