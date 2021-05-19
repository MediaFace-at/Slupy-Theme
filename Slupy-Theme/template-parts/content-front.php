<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slupy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row justify-content-center no-gutters" style="overflow: hidden;">
		<div class="col-md-9 col-12 bg-content">
			<!--<header class="entry-header" style="text-align: center;">
				<?php the_title( '<h1 class="entry-title headline margin-top">', '</h1>' ); ?>
			</header> .entry-header -->

			<?php slupy_post_thumbnail(); ?>

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
			<h2 class="entry-title shimmerfx headline margin-top"></h2>
			<?php echo do_shortcode('[get_girls rows="4"]'); ?>
			<h2 class="entry-title shimmerfx headline margin-top">Bald Verfügbar</h2>
			<?php echo do_shortcode('[get_girls_future rows="4"]'); ?>
			<?php if ( get_edit_post_link() ) : ?>
				<footer class="entry-footer">
					<?php
					edit_post_link(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Edit <span class="screen-reader-text">%s</span>', 'slupy' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						),
						'<span class="edit-link">',
						'</span>'
					);
					?>
				</footer><!-- .entry-footer -->
			<?php endif; ?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
