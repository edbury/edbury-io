<?php
/**
 * @package tummy rumblers
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<?php $title = explode(' ', get_the_title()); 
				$i = 0;
				$nocaps = explode(', ', 'a, an, the, and, but, or, so, after, before, when, while, since, until, although, even if, because, both, and, either, or, neither, nor, not, only, but, also, aboard, about, above, absent, across, after, against, along, alongside, amid, amidst, among, amongst, around, as, aslant, astride, at, atop, barring, before, behind, below, beneath, beside, besides, between, beyond, but, by, despite, down, during, except, failing, following, for, from, in, inside, into, like, merry, mid, minus, near, next, notwithstanding, of, off, on, onto, opposite, outside, over, past, plus, regarding, round, save, since, than, through, throughout, till, times, to, toward, towards, under, underneath, unlike, until, up, upon, via, with, within, without, according to, ahead of, as to, aside from, because of, close to, due to, far from, in to, inside of, instead of, near to, next to, on to, out of, outside of, owing to, prior to, subsequent to, as far as, as well as, by means of, in accordance with, in addition to, in front of, in place of, in spite of, on account of, on behalf of, on top of, with regard to, in case of, anti, betwixt, circa, cum, in lieu of, per, qua, sans, unto, versus, vis-a-vis, concerning, considering, regarding, apart from, but, except, plus, save, ago, apart, aside, away, hence, notwithstanding, on, through, withal');
				$break = true;
				$prevbig = false;
				foreach ($title as $word) {
					$word = strtolower($word);
					if ( in_array($word, $nocaps) ) {
						if ($i == 0) {
							echo "<span class='capitalize'>";
						} else if ( $prevbig ) {
							echo "<span class='kern'>";
						} else 	{
							echo "<span>";
						}
						echo $word;
						echo " ";
						echo "</span>";
						if ( $break && $i != 0 ) {
							echo "<br />";
						}
						$prevbig = false;
					} else {
						echo $word;
						echo " ";
						$break = false;
						$prevbig = true;
					}
					$i++;
				}
			?>
		</h1>
		
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<h2><span><?php tummy_rumblers_posted_on(); ?></span></h2>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'tummy_rumblers' ),
				'after'  => '</div>',
			) );
		?>
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
