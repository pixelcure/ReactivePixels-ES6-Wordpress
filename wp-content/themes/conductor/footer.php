          <?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Conductor Productions
 * @since Forever
 */
?>

		<footer class="outer-wrapper">
			<section class="footer-inner inner-wrapper">
		        
		        <div class="company-info">
					<h3 class="site-title">Conductor</h3>
        		</div><!-- / end left contact and company info -->

				<aside class="footer-nav">
          			<ul class="social-media">
          				<li class="twitter">
          					<a href="#" title="Facebook">
          						<span class="icon icon-fb"></span>
          					</a>
          				</li>
          				<li class="twitter">
          					<a href="#" title="Twitter">
          						<span class="icon icon-twitter"></span>
          					</a>
          				</li>
          				<li class="linked-in">
							<a href="#" title="Linked In">
								<span class="icon icon-linkedin"></span>
							</a>
          				</li>
          			</ul><!-- / end social media -->
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</aside><!-- / end footer nav -->

			</section><!-- / end footer inner -->	
		</footer><!-- / end footer -->

		<!--script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe5DYJZUSe9nw6NjyrYnxMAD3rH4khQY4"></script-->
		<!--script src="<?php //bloginfo('template_url'); ?>/app/scripts/main.js"></script-->
		<script src="<?php bloginfo('template_url'); ?>/app/scripts/build.js"></script>


		<?php wp_footer(); ?>
	</section><!-- /end outer wrapper -->
</body>
</html>
