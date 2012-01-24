<div class="post-header">
  <h2 class="title">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <span class="post-name"><?php the_title(); ?></span>
    </a>
    </h2>
    <h3 class="author">By: <?php the_author_link() ?></h3>
    <span class="post-date"><?php the_time('l, F jS, Y') ?></span>
</div>
<div class="entry">
  <?php the_content('Continuing reading...'); ?>
</div>
 <div class="comments">
  <?php comments_popup_link('0', '1', '%'); ?>
</div>
<div class="metadata">
  <span class="post-tags"><?php the_tags('Tags: <span class=post-tag>','</span>,<span class=post-tag>','</span>') ?></span>
</div>
