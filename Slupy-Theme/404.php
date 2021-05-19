<?php
/**
 *
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package slupy
 */

get_header();
if( !function_exists('redirect_404_to_homepage') ){

    add_action( 'template_redirect', 'redirect_404_to_homepage' );

    function redirect_404_to_homepage(){
       if(is_404()):
            wp_safe_redirect( home_url('/') );
            exit;
        endif;
    }
}
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found container bg-content">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( '404', 'slupy' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'Die Seite konnte leider nicht gefunden werden.', 'slupy' ); ?></p>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
