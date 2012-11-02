<?php
/**
 * @package huftgold
 * @since huftgold 1.0
 */
?>

<?php if ( get_post_format() == 'status' ) { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'huftgold' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<div class="entry-footer-meta">
				<div class="row taxonomies">
					<div class="six columns">
						<div class="entry-meta-cats">
							<?php //echo '<a href="'.get_post_format_link( get_post_format() ).'" title="Browse format: '.get_post_format().'">'.get_post_format().'</a>'; ?>
						</div>
					</div>
					<div class="six columns text-right">
						<div class="entry-meta-tags">
							<?php the_tags('', ' '); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="six columns">
						<a href="<?php echo get_permalink(); ?>" rel="bookmark">
							<time class="entry-date" datetime="<?php get_the_date( 'c' ); ?>" pubdate>
								<?php the_time('n.d.y H:i'); ?>
							</time>
						</a>
					</div>
					<div class="six columns text-right">
						<a href="<?php echo wp_get_shortlink(); ?>" title="Short URL for this page"><?php echo wp_get_shortlink(); ?></a>
					</div>
				</div>
			</div>


			<?php edit_post_link( __( 'Edit', 'huftgold' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->

<?php } else { ?>

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
						<a href="<?php echo wp_get_shortlink(); ?>" title="Short URL for this page"><?php echo wp_get_shortlink(); ?></a>
					</div>
				</div>
			</div>


			<?php edit_post_link( __( 'Edit', 'huftgold' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->

<?php } ?>