<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> style="background-image: url(<?php echo get_template_directory_uri().'/img/bg-pattern.png' ?>); background-repeat:repeat; background-size: 150px;">

<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'slupy' ); ?></a>
	<div class="top-header row justify-content-center no-gutters" style="overflow: hidden;">
		<div class="col-md-9 col-12">
			<?php if ( is_active_sidebar( 'top-header-one' ) ) : ?>
				<div class="top-header-item">
					<?php dynamic_sidebar( 'top-header-one' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'top-header-two' ) ) : ?>
				<div class="top-header-item">
					<?php dynamic_sidebar( 'top-header-two' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'top-header-three' ) ) : ?>
				<div class="top-header-item">
					<?php dynamic_sidebar( 'top-header-three' ); ?>
				</div>
			<?php endif; ?>
		</div>	
		<div class="clear"></div>
	</div><!-- .top header -->
	
	<header id="masthead" class="site-header row justify-content-center no-gutters">
		<div class="col-md-9 col-12 d-flex justify-content-between align-items-center">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$slupy_description = get_bloginfo( 'description', 'display' );
				if ( $slupy_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $slupy_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
			
			<nav id="site-navigation" class="main-navigation">
				<?php the_custom_logo(); ?>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
				?>
				<a class="btn btn-success btn-block maps-route" style="color: white;" href="https://www.google.at/maps/dir//Laufhaus+Lagergasse+126,+Lagergasse+126,+8020+Graz/@47.0560308,15.4319863,17z/data=!4m9!4m8!1m0!1m5!1m1!1s0x476e35610a0ad697:0x885f21dab89a8e9b!2m2!1d15.434175!2d47.0560272!3e0" target="_blank" rel="noopener">Route</a>
			</nav><!-- #site-navigation -->
			<div id="menu-icon">
				<span></span>
			</div>
			<div id="closer">
				<span></span>
			</div>

		</div>
	</header><!-- #masthead -->
