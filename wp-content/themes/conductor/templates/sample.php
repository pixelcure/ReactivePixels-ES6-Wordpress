<?php
/**
 * The template for displaying the sample layout.
 *
 * Template Name: Sample
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
get_header(); ?>

<?php the_post(); ?>

<h1>Example Page Template</h1>

<p>This is a sample page template that behaves like an archive, which is to say it loads a loop of posts from a custom post type "samples."</p>

<?php include(get_template_directory().'/loops/loop-sample.php'); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>