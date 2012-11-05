<?php
/**
 * @package huftgold
 * @since huftgold 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'huftgold' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php huftgold_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'huftgold' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'huftgold' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<div class="entry-footer-meta">
			<div class="row taxonomies">
				<div class="four columns">
					<div class="entry-meta-cats">
						<?php if ( get_post_format() ) 
							//echo get_post_format_link( get_post_format() );
						?>
					</div>
				</div>
				<div class="eight columns text-right">
					<div class="entry-meta-tags">
						<?php the_tags('', ' '); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns text-right">
					<a class="shortlink" href="<?php echo wp_get_shortlink(); ?>" title="Short URL for this page"><?php echo preg_replace('"http://"', '', wp_get_shortlink()); ?></a>
				</div>
			</div>
		</div>


		<?php //edit_post_link( __( 'Edit', 'huftgold' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
