<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
get_header(); ?>

<?php the_post(); ?>

	<h1><?php echo get_the_author(); ?></h1>

	<?php if ( get_the_author_meta( 'description' ) ) : ?>
		<p><?php echo get_avatar( get_the_author_meta('user_email'), 60 ); ?></p>
		<h2>About <?php echo get_the_author(); ?></h2>
		<p><?php the_author_meta( 'description' ); ?></p>
	<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>