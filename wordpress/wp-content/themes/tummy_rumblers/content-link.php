<?php
/**
 * @package tummy rumblers
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php echo link_yoink( get_the_content() ); ?>" title="<?php the_title; ?>"><?php the_title(); ?> <span class="arrow">&rarr;</span></a>
		</h1>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<div class="entry-footer-meta">
			<div class="row taxonomies">
				<div class="large-4 columns">
					<div class="entry-meta-cats">
						<?php //echo '<a href="'.get_post_format_link( get_post_format() ).'" title="Browse format: '.get_post_format().'">'.get_post_format().'</a>'; ?>
					</div>
				</div>
				<div class="large-8 columns text-right">
					<div class="entry-meta-tags">
						<?php the_tags('', ' '); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns text-right">
					<div>
						<a href="<?php echo get_permalink(); ?>" rel="bookmark">
							<time class="entry-date" datetime="<?php get_the_date( 'c' ); ?>" pubdate>
								<?php the_time('g:i a - j M y'); ?>
							</time>
						</a>
					</div>
					<div class="short-container">
						<a class="shortlink" href="<?php echo wp_get_shortlink(); ?>" title="Short URL for this page"><?php echo preg_replace('"http://"', '', wp_get_shortlink()); ?></a>
					</div>
				</div>
			</div>
		</div>


		<?php //edit_post_link( __( 'Edit', 'huftgold' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
