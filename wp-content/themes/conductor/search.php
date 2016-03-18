<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
get_header(); ?>

<h1>Search Results for: <?php get_search_query(); ?></h1>

<?php include(get_template_directory().'/loops/loop.php'); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>