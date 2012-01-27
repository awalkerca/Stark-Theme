<?php get_header(); ?>
  <div class="page <?= get_page_location() ?>">
    <div id="content" class="error-404">
      <?php if (theme_option('content_slider_enabled') && is_front_page() ){$featured_content->display_content();} ?>
      <h1>Oops! Page Not Found</h1>
      <p>It looks like you've stumbled across a page that doesn't exist, or has been moved.</p>
      <p>Try heading back to the <a href="<?= bloginfo('url')?>">Main Page</a>, and see if you can find what you're looking for.</p>
    </div>
  </div>
<?php get_footer(); ?>