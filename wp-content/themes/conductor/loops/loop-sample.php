<?php
/**
 * The default template for displaying a loop of posts from a custom post type.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
?>

<?php query_posts(array('post_type'=>'samples','posts_per_page'=>-1)); ?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>
		
		<hr />

	<?php endwhile; ?>

<?php else : ?>

	<p>There are no results.</p>

<?php endif; ?>