<?php get_header(); ?>
  <div class="main_body <?= get_page_location() ?>">
    <div id="content">
    <?php if(have_posts()) : ?>
      <?php while(have_posts()) : the_post(); ?>
        <div class="post" id="post-<?php the_id();?> ">
          <h2 class="title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
            </a>
	        </h2>
	        <div class="entry">
	            <?php the_excerpt(); ?>
	        </div>
	        <div class="metadata">
            <span class="categories">Filed under: <?php the_category(', '); ?></span>
            <span class="author">by: <?php the_author(); ?></span>
            <div class="comments">
              <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
              <?php edit_post_link('Edit', ' &#124; ', ''); ?>
            </div>
	        </div>
        </div>
      <?php endwhile; ?>
      <div class="nav">
        <?php get_template_part( 'nav','single' ); ?>
      </div>
    <?php else : ?>
      <div class="post">
        <h2>Not Found</h2>
      </div>
    <?php endif; ?>
    </div>
  </div>
<?php get_footer(); ?>