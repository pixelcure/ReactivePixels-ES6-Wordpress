<?php
/**
 * The template for displaying all pages.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
get_header(); ?>

  <section class="outer-wrapper page content">
    <section class="inner-wrapper">
		<h1 class="title"><? the_title(); ?></h1>
    	<div class="inner-content row">		
	    	<div class="content span_8">		
			      	<?php the_post(); ?>
			      	<?php the_content(); ?>
	    	</div><!--/ end content -->
	    	<aside class="sidebar span_3">
		      <?php
		        $innerSideBarArgs = array( 'post_type' => 'innerSideBar', 'posts_per_page' => 1 );
		        $innerSideBarLoop = new WP_Query( $innerSideBarArgs );
		        while ( $innerSideBarLoop->have_posts() ) : $innerSideBarLoop->the_post();
		      ?>
				<?php the_content(); ?>
		      <?php
		        endwhile;
		      ?>
	    	</aside><!-- / end side bar -->
    	</div><!-- / end inner content -->
    </section><!-- / end inner wrapper -->
  </section><!-- / end page inner content -->

<?php get_footer(); ?>