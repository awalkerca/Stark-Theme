<?php get_header(); ?>
  <div class="main_body">
    <div id="content" class="<?=get_page_location() ?>">
    <?php get_template_part('loop','category'); ?>
    </div>
  </div>
<?php get_footer(); ?>