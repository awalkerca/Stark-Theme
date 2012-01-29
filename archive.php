<?php get_header(); ?>
  <div class="main_body <?= get_page_location() ?>">
    <div id="content">
    <?php get_template_part('loop','archive'); ?>
    </div>
  </div>
<?php get_footer(); ?>
