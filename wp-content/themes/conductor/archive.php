<?php
/**
 * The template for displaying Archive pages.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
get_header(); ?>

<?php if ( is_day() ) : ?>
	<h1>Daily Archives: <?php echo get_the_date() ?></h1>
<?php elseif ( is_month() ) : ?>
	<h1>Monthly Archives: <?php echo get_the_date( 'F Y' ); ?></h1>
<?php elseif ( is_year() ) : ?>
	<h1>Yearly Archives: <?php echo get_the_date( 'Y' ); ?></h1>
<?php elseif ( is_category() ) : ?>
	<h1>Category: <?php single_cat_title(); ?></h1>
<?php elseif ( is_tag() ) : ?>
	<h1>Tags: <?php single_tag_title(); ?></h1>
<?php else : ?>
	<h1>Blog Archives</h1>
<?php endif; ?>

<hr />

<?php 
	// we use include instead of get_template_part because of variable scope
	include(get_template_directory().'/loops/loop.php'); 
?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>