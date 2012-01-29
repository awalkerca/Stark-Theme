<?php get_header(); ?>
  <div class="main_body <?= get_page_location() ?>">
    <div id="content">
    <?php if(have_posts()) : ?>
      <?php while(have_posts()) : the_post(); ?>
        <div class="post" id="post-<?php the_id();?> ">
          <div class="post_header">
            <h2 class="title">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <span class="post-name"><?php the_title(); ?></span>
              </a>
            </h2>
            <?php $author_location = theme_option('display_author');
              if ($author_location == 'top'){
               ?>
                <div class="author">
                  <h3 class="author">By: <?php the_author_link() ?></h3>
                </div>
               <?php 
              }
            ?>
            <?php $date_location = theme_option('display_date');
              if ($date_location == 'top'){
               ?>
                <div class="date">
                  <?php the_time('l, F jS, Y') ?>
                </div>
               <?php 
              }
            ?>  
          </div>
          <div class="entry">
            <?php the_content(); ?>
          </div>
          <div class="post_footer">
            <?php 
              if ($author_location == 'end'){
               ?>
                <div class="author">
                  <h3 class="author">By: <?php the_author_link() ?></h3>
                </div>
               <?php 
              }
            ?>
            <?php 
              if ($date_location == 'end'){
               ?>
                <div class="date">
                  <?php the_time('l, F jS, Y') ?>
                </div>
               <?php 
              }
            ?>
          </div>
          <div class="metadata">
            <span class="post-tags"><?php the_tags('Tags: <span class=post-tag>','</span>,<span class=post-tag>','</span>') ?></span>
            <?php 
              if (theme_option('display_metadata')){
               ?>
                <?php the_meta(); ?>
               <?php 
              }
            ?>            
          </div>
          <div id="comments" class="comments">
            <?php comments_template(); ?>
          </div>
        </div>
      <?php endwhile; ?>
      <div class="nav">
        <?php previous_post_link('<span class="prev">%link</span>'); ?>
        <?php next_post_link('<span class="next">%link</span>'); ?>
      </div>
    <?php else : ?>
      <div class="post">
        <h2>Not Found</h2>
      </div>
    <?php endif; ?>
    </div>
  </div>
<?php get_footer(); ?>