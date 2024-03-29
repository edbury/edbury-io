<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package tummy rumblers
 */
?>

			</div><!-- #main -->
		</div>
	</div>
</div>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="row">
		<div class="large-12 columns">
			<nav id="site-navigation" class="navigation-main" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
			<div class="site-info">
				<?php do_action( 'tummy_rumblers_credits' ); ?>
				<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'tummy_rumblers' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'tummy_rumblers' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</div>
	</div>
</footer><!-- #colophon -->

<script>
causeRepaintsOn = jQuery("h1, h2, h3, p");

jQuery(window).resize(function() {
  causeRepaintsOn.css("z-index", 1);
});
</script>

<?php wp_footer(); ?>


</body>
</html>