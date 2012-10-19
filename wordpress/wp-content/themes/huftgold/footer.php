<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package huftgold
 * @since huftgold 1.0
 */
?>

			</div><!-- #main .site-main -->

			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="row">
					<div class="twelve columns">
						<div class="site-info">
							<?php do_action( 'huftgold_credits' ); ?>
							<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'huftgold' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'huftgold' ), 'WordPress' ); ?></a>
						</div><!-- .site-info -->
					</div>
				</div>
			</footer><!-- #colophon .site-footer -->
		</div><!-- #page .hfeed .site -->
	</div><!-- .eight .columns -->
</div><!-- .row -->

<?php wp_footer(); ?>

</body>
</html>