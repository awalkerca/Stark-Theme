<?php
/*
 * Template Name: Blog List
 */
?>

<?php get_header(); ?>
  <div class="main_body <?= get_page_location() ?>">
    <div id="content">
    <?php
        $query_args = array(
            'paged'             => get_query_var('paged')
        );
        query_posts($query_args);
    ?>
    <?php get_template_part('loop','blog-list'); ?>
    </div>
  </div>
<?php get_footer(); ?>