<?php
/**
 * The default template for displaying a standard loop of posts.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>
		
	<?php endwhile; ?>

<?php else : ?>

	<p>There are no results.</p>

<?php endif; ?>