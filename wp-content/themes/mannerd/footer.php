<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php get_sidebar( 'main' ); ?>

			<div class="site-info">
				<?php do_action( 'twentythirteen_credits' ); ?>
				<div id="social-icons">
					<a id="facebook" target="_blank" href="http://facebook.com/mannerdisms"><i class="fa fa-facebook fa-fw fa-2x"></i></a>
					<a id="twitter" target="_blank" href="http://twitter.com/mannerdisms"><i class="fa fa-twitter fa-fw fa-2x"></i></a>
					<a id="pinterest" target="_blank" href="http://pinterest.com/mannerdisms"><i class="fa fa-pinterest fa-fw fa-2x"></i></a>
					<a id="instagram" target="_blank" href="http://instagram.com/mannerdisms"><i class="fa fa-instagram fa-fw fa-2x"></i></a>
				</div>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/mannerd-white.png" title="<?php bloginfo( 'name' ); ?>" height="20px"/></a></br>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">&copy; <?php echo number_to_roman(date('Y')); ?></a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>

	<?php
	$host = $_SERVER['HTTP_HOST']; 
 	if($host == "www.mannerd.com" or $host == "mannerd.com" && !current_user_can( 'edit_posts' ) && !is_admin()) {; ?>
    	<!--Google Analytics, since we're on the live site-->
		<script>
	  		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  		ga('create', 'UA-50385855-1', 'auto');
	  		ga('send', 'pageview');
		</script>
	<?php } 
	else {; ?>
		<!--Nope, no Google Analytics here.-->
	<?php }; ?>



</body>
</html>
