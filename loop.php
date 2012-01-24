<?php if(have_posts()) : ?>
  <?php while(have_posts()) : the_post(); ?>
    <div class="post" id="post-<?php the_id();?> ">
      <?php get_template_part('post','full'); ?>
    </div>
  <?php endwhile; ?>
  <div class="nav">
    <?php posts_nav_link('<span class="divider">|</span>','<span class="next">Newer Posts</span>','<span class="prev">Older Posts</span>'); ?>
  </div>
<?php else : ?>
  <div class="post">
    <h2>Not Found</h2>
  </div>
<?php endif; ?>