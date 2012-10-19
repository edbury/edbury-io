<?php
/**
 * @package huftgold
 * @since huftgold 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php huftgold_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'huftgold' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<div class="entry-footer-meta">
			<div class="row taxonomies">
				<div class="six columns">
					<div class="entry-meta-cats">
						<?php if ( get_post_format() ) 
							echo get_post_format_link( get_post_format() );
						?>
					</div>
				</div>
				<div class="six columns text-right">
					<div class="entry-meta-tags">
						<?php the_tags('', ' '); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns text-right">
					<a href="<?php echo wp_get_shortlink(); ?>" title="Short URL for this page"><?php echo wp_get_shortlink(); ?></a>
				</div>
			</div>
		</div>


		<?php edit_post_link( __( 'Edit', 'huftgold' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
