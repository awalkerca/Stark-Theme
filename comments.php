<?php // Do not delete these lines
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Please do not load this page directly. Thanks!');
if (!empty($post->post_password)) { // if there's a password
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
?>
<h2><?php _e('Password Protected'); ?></h2>
<p><?php _e('Enter the password to view comments.'); ?></p>
<?php return;
	}
}
/* This variable is for alternating comment background */
$oddcomment = 'odd';
?>

<!-- You can start editing here. -->
<?php if ($comments) : ?>
    <h3 id="comments">
        <?php comments_number('No Responses', 'One Response', '% Responses' );?> to
        &#8220;<?php the_title(); ?>&#8221;
    </h3>
    <ol class="commentlist">
    <?php foreach ($comments as $comment) : ?>
	<li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
            <div class="commentmetadata">
                <span class="comment-author"><?php comment_author_link() ?></span>
                <?php _e('('); ?>
                <span class="comment-date"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F jS, Y') ?> <?php _e('at');?> <?php comment_time() ?></a></span>
                <?php _e(')'); ?>
                <div class="comment-actions">
                    <?php edit_comment_link('<span>Edit Comment</span>','',''); ?>
                </div>
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php _e('Your comment is awaiting moderation.'); ?></em>
                <?php endif; ?>
            </div>
            <div class="comment-body">
                <?php comment_text() ?>
            </div>
	</li>

        <?php /* Changes every other comment to a different class */
            if ('odd' == $oddcomment) $oddcomment = 'even';
            else $oddcomment = 'odd';
        ?>
        <?php endforeach; /* end for each comment */ ?>
    </ol>
    <?php else : // this is displayed if there are no comments so far ?>
    <?php if ('open' == $post->comment_status) : ?>
        <!-- If comments are open, but there are no comments. -->
        <p class="nocomments">Be the first to comment!</p>
    <?php else : // comments are closed ?>

        <!-- If comments are closed. -->
        <p class="nocomments">Comments are closed.</p>
    <?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>
    <h3 id="respond">Leave a Reply</h3>
    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.</p>
    <?php else : ?>
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        <?php if ( $user_ID ) : ?>
            <div class="comment-login-bar">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">
                <?php echo $user_identity; ?></a>.
                <a class="logout" href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout</a>
            </div>
            <?php else : ?>
                <div class="input">
                    <label for="author">Name <?php if ($req) echo "(required)"; ?></label>
                    <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" />
                </div>
                <div class="input">
                    <label for="email">Mail (will not be published) <?php if ($req) echo "(required)"; ?></label>
                    <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>"  tabindex="2" />
                </div>
                <div class="input">
                    <label for="url">Website</label>
                    <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>"  tabindex="3" />
                </div>
            <?php endif; ?>

<!--<p><small><strong>XHTML:</strong> <?php _e('You can use these tags&#58;'); ?> <?php echo allowed_tags(); ?></small></p>-->

        <p><textarea name="comment" id="comment" tabindex="4"></textarea></p>
        <p><input name="submit" type="submit" id="submit" tabindex="5" value="Share Comment" />
        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
        </p>
    <?php do_action('comment_form', $post->ID); ?>
    </form>
    <?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>