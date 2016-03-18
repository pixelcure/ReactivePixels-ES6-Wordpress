<?php
/**
 * The template for displaying all sample posts.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
get_header(); ?>

<?php the_post(); ?>

<h1><?php the_title(); ?></h1>

<p><em>Presumably samples have a different layout.</em></p>

<?php the_content(); ?>

<?php comments_template( '', true ); ?>

<hr />

<?php get_sidebar(); ?>
<?php get_footer(); ?>