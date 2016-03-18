<?php
/**
 * The template for displaying Comments.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
?>

	<?php if ( post_password_required() ) : ?>
		<p>This post is password protected. Enter the password to view any comments.</p>
	<?php
		return;
		endif;
	?>

	<h3><?php comments_number( '0 Comments', '1 Comments', '% Comments' ); ?></h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text">Comment Navigation</h1>
			<div class="nav-previous"><?php previous_comments_link( '&larr; Older Comments' ); ?></div>
			<div class="nav-next"><?php next_comments_link( 'Newer Comments &rarr;' ); ?></div>
		</nav>
	<?php endif; // check for comment navigation ?>

	<?php if ( have_comments() ) : ?>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'sandbox_comment' ) ); ?>
		</ol>
	
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below">
				<h1 class="assistive-text">Comment Navigation</h1>
				<div class="nav-previous"><?php previous_comments_link( '&larr; Older Comments' ); ?></div>
				<div class="nav-next"><?php next_comments_link( 'Newer Comments &rarr;' ); ?></div>
			</nav>
		<?php endif; // check for comment navigation ?>

	<?php elseif ( !comments_open() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		
		<p>Comments are closed.</p>
	
	<?php endif; ?>

	<?php comment_form(); ?>