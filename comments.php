<?php
/*
The comments page for Bones
*/

// don't load it if you can't comment
if ( post_password_required() ) {
  return;
}

?>

<?php // You can start editing here. ?>

  <?php if ( have_comments() ) :

	$fromPost = 'post_id='.$post->ID;
	$comments = get_comments( $fromPost );

	// print_r($comments);
	$comments = array_reverse($comments);
	$comments_count = 0;

	if ( function_exists('get_field') ){
		$global_max_quota = get_field('max_quota', 'option');
		$specific_max_quota = get_field('max_quota');

		if ( $specific_max_quota ){
			$max_quota = $specific_max_quota;
		} elseif ( $global_max_quota ){
			$max_quota = $global_max_quota;
		} else {
			$max_quota = 1;
		}
	} else {
		$max_quota = 1;
	}

	$site_url = get_site_url();
	$edit_comment_url = $site_url."/wp-admin/comment.php?action=editcomment&c=";

	echo "<div class='slots taken'>";
		foreach ($comments as $comment) {
			$author = $comment->comment_author;
			$date = $comment->comment_date;
			$comment_ID = $comment->comment_ID;
			$comments_count++;

			if ( $comments_count == $max_quota+1 ){
				echo "</div>
						<div class='slots'>
							<div class='slot single waitlist'>
								Waitlist
							</div>
						</div>
					<div class='slots taken'>";
			}

			?>
			<div class="slot" href="<?php the_permalink(); ?>"><?php echo $author ?>
				<?php
					if (current_user_can( 'manage_options' )) { ?>
				        <span>
				        	<a href="<?php echo $edit_comment_url.$comment_ID; ?>">
				        		<i class="fa fa-pencil"></i>
				        	</a>
				        </span>
				   <?php }
				?>
			</div>
			<?php
		}
	echo "</div>";
?>


    <?php if ( ! comments_open() ) : ?>
    	<p class="no-comments"><?php _e( 'Comments are closed.' , 'bonestheme' ); ?></p>
    <?php endif; ?>

  <?php endif; ?>

<?php
  $args = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'class_submit'      => 'submit',
  'name_submit'       => 'submit',
  'title_reply'       => __( '' ),
  'title_reply_to'    => __( 'Leave a Reply to %s' ),
  'cancel_reply_link' => __( 'Cancel Reply' ),
  'label_submit'      => __( 'Claim It' ),
  'format'            => 'xhtml',
  $fields =  array(
	  'author' =>
	    '<p class="comment-form-author"><label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' .
	    ( $req ? '<span class="required">*</span>' : '' ) .
	    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
	    '" size="30" /></p>',

	  'email' =>
	    '<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' .
	    ( $req ? '<span class="required">*</span>' : '' ) .
	    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
	    '" size="30" /></p>',
	),

    'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( '', 'noun' ) .
    '</label><input type="hidden" value="I would like this one" id="comment" name="comment" placeholder="" cols="45" rows="8" aria-required="true">' .
    '</input></p>',

  'must_log_in' => '<p class="must-log-in">' .
    sprintf(
      __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    ) . '</p>',

  'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p>',

  'comment_notes_before' => '',

  'comment_notes_after' => '',

  'fields' => apply_filters( 'comment_form_default_fields', $fields ),
);

?>


<?php
// if ( get_comments_number()==0 ) {
    comment_form( $args );
// } else {

// }
?>
