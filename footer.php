<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package slupy
 */

?>

	<footer id="colophon" class="site-footer oöivnsoöefvsöefvisöklfnsklöefvnseklöfgvsklöefv">
		<div class="site-info container class">
			<?php if ( is_active_sidebar( 'footer-sidebar-one' ) ) : ?>
			<div class="footer-item">
				<?php dynamic_sidebar( 'footer-sidebar-one' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-sidebar-two' ) ) : ?>
			<div class="footer-item">
				<?php dynamic_sidebar( 'footer-sidebar-two' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-sidebar-three' ) ) : ?>
			<div class="footer-item">
				<?php dynamic_sidebar( 'footer-sidebar-three' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-sidebar-four' ) ) : ?>
			<div class="footer-item">
				<?php dynamic_sidebar( 'footer-sidebar-four' ); ?>
				</div>
			<?php endif; ?>
		</div><!-- .site-info -->
		<div class="clear"></div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
