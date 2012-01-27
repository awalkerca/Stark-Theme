<?php
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Please do not load this page directly. Thanks!');
if (!empty($post->post_password)) { // if there's a password
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie ?>
    <h2><?php _e('Password Protected'); ?></h2>
    <p><?php _e('Enter the password to view comments.'); ?></p>
    <?php return;
	}
}
?>

<?php if ($comments) : ?>
  <h3><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?> &#8221;</h3>
  <ol class="comment_list">
    <?php wp_list_comments(array('style','ol')); ?>
  </ol>
<?php else : // this is displayed if there are no comments so far ?>
    <?php if ('open' == $post->comment_status) : ?>
      <p class="nocomments">Be the first to comment!</p>
    <?php else : // comments are closed ?>
      <p class="nocomments">Comments are closed.</p>
    <?php endif; ?>
<?php endif; ?>
<?php comment_form(); ?>