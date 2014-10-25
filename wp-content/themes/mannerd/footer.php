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
				<!--<div id="social-icons">
					<a id="facebook" target="_blank" href="http://facebook.com/mannerdisms"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
					<a id="twitter" target="_blank" href="http://twitter.com/mannerdisms"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
					<a id="pinterest" target="_blank" href="http://pinterest.com/mannerdisms"><i class="fa fa-pinterest fa-fw fa-3x"></i></a>
				</div>-->
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/mannerd-white.png" title="<?php bloginfo( 'name' ); ?>" height="20px"/></a></br>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">&copy; <?php echo number_to_roman(date('Y')); ?></a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
	<!--Add Google Analytics code here-->
</body>
</html>
