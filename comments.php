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

  <?php if ( have_comments() ) : ?>

<?php
$fromPost = 'post_id='.$post->ID;
$claims = get_comments( $fromPost );
$claims = array_reverse($claims);
$claims_count = 0;

foreach ($claims as $claim) {
	$author = $claim->comment_author;
	$date = $claim->comment_date;
	$claims_count++;

	if ( $claims_count == 2 ){
		echo "<h2>Waitlist</h2>";
	}

	if ( $claims_count == 1 ){
		echo "<p>{$author} claimed this on {$date}.</p>";
	} elseif ( $claims_count > 1 ) {
		echo "<p>{$author} joined the waitlist on {$date}.</p>";
	}
}
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
