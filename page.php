<?php get_header(); ?>
  <div class="page <?= get_page_location() ?>">
    <div id="content">
      <?php if (theme_option('content_slider_enabled') && is_front_page()){$featured_content->display_content();} ?>
    <?php if(have_posts()) : ?>
      <?php while(have_posts()) : the_post(); ?>
        <div class="post" id="post-<?php the_id();?> ">          
        <?php if ( theme_option('page_title_on_homepage') || (!is_front_page())) { ?>
          <div class="page-header">
            <h2 class="title">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <span class="post-name"><?php the_title(); ?></span>
              </a>
            </h2>
          </div>
        <?php } ?>

          <div class="entry">
              <?php the_content(); ?>
          </div>

          <div class="nav">
            <?php wp_link_pages(); ?>
          </div> 
                    
        </div>        
      <?php endwhile; ?>
    <?php else : ?>
      <div class="post">
        <h2 class="no-posts">Sorry, no page by that name here.</h2>
      </div>
    <?php endif; ?>
    </div>
  </div>
<?php get_footer(); ?>