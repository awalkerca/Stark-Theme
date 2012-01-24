<?php get_header(); ?>
  <div class="page <?= get_page_location() ?>">
    <div id="content">
    <?php get_template_part('loop','archive'); ?>
    </div>
  </div>
<?php get_footer(); ?>
