<?php
/** 
 * slupy functions and definitions
 */

@ini_set( 'upload_max_size' , '128M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

if ( ! defined( 'Slupy_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'Slupy_VERSION', '1.0.0' );
}

if ( ! function_exists( 'slupy_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function slupy_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'slupy', get_template_directory() . '/lang' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'slupy' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'slupy_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'slupy_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function slupy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'slupy_content_width', 640 );
}
add_action( 'after_setup_theme', 'slupy_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function slupy_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'slupy' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'slupy' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'slupy_widgets_init' );
 
/**
 * Enqueue scripts and styles.
 */
function slupy_scripts() {

	wp_enqueue_style('bootstrap', get_template_directory_uri() .'/css/bootstrap.min.css', array());
	wp_enqueue_style('simple-lightbox-css', get_template_directory_uri() .'/css/simple-lightbox.min.css', array());
	wp_enqueue_style('flag-icons', 'https://cdn.jsdelivr.net/npm/round-flag-icons/css/round-flag-icons.min.css', array());
	wp_enqueue_style('slupy-styles', get_template_directory_uri() .'/css/slupy-styles.css', array());
	wp_enqueue_style('slupy-color-styles', get_template_directory_uri() .'/css/slupy-color-styles.css', array());
	wp_enqueue_style('fontawesome-css', get_template_directory_uri() .'/css/fontawesome/css/all.css', array());
	wp_enqueue_style( 'slupy-theme-style', get_stylesheet_uri(), array(), Slupy_VERSION );
	
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), true );
	wp_enqueue_script( 'simple-lightbox-js', get_template_directory_uri() . '/js/simple-lightbox.jquery.min.js', array('jquery'), true );
	wp_enqueue_script( 'parallax-js', get_template_directory_uri() . '/js/jquery.parallax.min.js', array('jquery'), true );
	wp_enqueue_script( 'slupy-js', get_template_directory_uri() . '/js/slupy-js.js', array('jquery'), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'slupy_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// This will suppress empty email errors when submitting the user form
add_action('user_profile_update_errors', 'my_user_profile_update_errors', 10, 3 );
function my_user_profile_update_errors($errors, $update, $user) {
$errors->remove('empty_email');
}

// This will remove javascript required validation for email input
// It will also remove the '(required)' text in the label
// Works for new user, user profile and edit user forms
add_action('user_new_form', 'my_user_new_form', 10, 1);
add_action('show_user_profile', 'my_user_new_form', 10, 1);
add_action('edit_user_profile', 'my_user_new_form', 10, 1);
function my_user_new_form($form_type) {
?>
<script type="text/javascript">
	jQuery('#email').closest('tr').removeClass('form-required').find('.description').remove();
	// Uncheck send new user email option by default
	<?php if (isset($form_type) && $form_type === 'add-new-user') : ?>
	 jQuery('#send_user_notification').removeAttr('checked');
	<?php endif; ?>
</script>
<?php
}

/* Create Staff Member User Role */
add_role(
    'staff', //  System name of the role.
    __( 'Mitarbeiter'  ), // Display name of the role.
    array(
        'read'  => true,
        'delete_posts'  => true,
        'delete_published_posts' => true,
        'edit_posts'   => true,
        'publish_posts' => true,
        'upload_files'  => true,
        'edit_pages'  => true,
        'edit_published_pages'  =>  true,
        'publish_pages'  => true,
        'delete_published_pages' => false, // This user will NOT be able to  delete published pages.
    )
);


function calcAge($date){
	//date in mm/dd/yyyy format; or it can be in other formats as well
	$birthDate = $date;
	//explode the date to get month, day and year
	$birthDate = explode("/", $birthDate);
	//get age from date or birthdate
	$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
		? ((date("Y") - $birthDate[2]) - 1)
		: (date("Y") - $birthDate[2]));
	echo $age;	
}

// Footer Sidebars //
function slupyFooterSidebarOne() {
    register_sidebar(
        array (
            'name' => __( 'Footerbar Block 1', 'slupy' ),
            'id' => 'footer-sidebar-one',
            'description' => __( 'Custom Footer Sidebar Block 1', 'slupy' ),
            'before_widget' => '<div class="footer-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'slupyFooterSidebarOne' );
function slupyFooterSidebarTwo() {
    register_sidebar(
        array (
            'name' => __( 'Footerbar Block 2', 'slupy' ),
            'id' => 'footer-sidebar-two',
            'description' => __( 'Custom Footer Sidebar Block 2', 'slupy' ),
            'before_widget' => '<div class="footer-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'slupyFooterSidebarTwo' );
function slupyFooterSidebarThree() {
    register_sidebar(
        array (
            'name' => __( 'Footerbar Block 3', 'slupy' ),
            'id' => 'footer-sidebar-three',
            'description' => __( 'Custom Footer Sidebar Block 3', 'slupy' ),
            'before_widget' => '<div class="footer-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'slupyFooterSidebarThree' );
function slupyFooterSidebarFour() {
    register_sidebar(
        array (
            'name' => __( 'Footerbar Block 4', 'slupy' ),
            'id' => 'footer-sidebar-four',
            'description' => __( 'Custom Sidebar Block 4', 'slupy' ),
            'before_widget' => '<div class="footer-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'slupyFooterSidebarFour' );

// Top Header Content für Widgets //
function slupyTopHeader() {
    register_sidebar(
        array (
            'name' => __( 'Top Header Block 1', 'slupy' ),
            'id' => 'top-header-one',
            'description' => __( 'Top Header Content 1', 'slupy' ),
            'before_widget' => '<div class="top-header-content">',
            'after_widget' => "</div>",
            'before_title' => '<span class="d-none">',
            'after_title' => '</div>',
        )
    );
}
add_action( 'widgets_init', 'slupyTopHeader' );
function slupyTopHeaderOne() {
    register_sidebar(
        array (
            'name' => __( 'Top Header Block 2', 'slupy' ),
            'id' => 'top-header-two',
            'description' => __( 'Top Header Content 2', 'slupy' ),
            'before_widget' => '<div class="top-header-content">',
            'after_widget' => "</div>",
            'before_title' => '<span class="d-none">',
            'after_title' => '</span>',
        )
    );
}
add_action( 'widgets_init', 'slupyTopHeaderOne' );
function slupyTopHeaderTwo() {
    register_sidebar(
        array (
            'name' => __( 'Top Header Block 3', 'slupy' ),
            'id' => 'top-header-three',
            'description' => __( 'Top Header Content 3', 'slupy' ),
            'before_widget' => '<div class="top-header-content">',
            'after_widget' => "</div>",
            'before_title' => '<span class="d-none">',
            'after_title' => '</span>',
        )
    );
}
add_action( 'widgets_init', 'slupyTopHeaderTwo' );


function custom_admin_js() {
    $url = get_bloginfo('template_directory') . '/js/admin-script.js';
    echo '"<script type="text/javascript" src="'. $url . '"></script>"';
}
add_action('admin_footer', 'custom_admin_js');

function wpb_custom_logo() {
	echo '
	<style type="text/css">
	#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
	background-image: url(' . get_bloginfo('stylesheet_directory') . '/img/slupy-logo-512.png) !important;
	background-position: 0 0;
	background-size: 100%;
	padding:5px;
	color:rgba(0, 0, 0, 0);
	}
	#wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
	background-position: 0 0;
	}
	</style>
	';
	}
	 
	//hook into the administrative header output
add_action('wp_before_admin_bar_render', 'wpb_custom_logo');

add_action('customize_register','theme_customizer_options');
/*
 * Add in our custom Accent Color setting and control to be used in the Customizer in the Colors section
 *
 */
function theme_customizer_options( $wp_customize ) {

$wp_customize->add_panel( 'theme_options', array(
	'priority'       => 10,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
	'title'          => 'Theme Options',
	'description'    => 'Certain options for the Theme.',
) );



$wp_customize->add_section( 'color_vars', array(
	'title' => __( 'Color Theme', 'customizer_color_options_section' ),
	'priority' => 10,
	'panel' => 'theme_options',
) );

	
$wp_customize->add_setting(
	'main_color', //give it an ID
	array(
		'default' => '#E6007E', // Give it a default
	)
);
$wp_customize->add_control(
   new WP_Customize_Color_Control(
	   $wp_customize,
	   'main_color', //give it an ID
	   array(
		   'label'      => __( 'Haupt Farbe der Website', 'slupy' ), //set the label to appear in the Customizer
		   'section'    => 'color_vars', //select the section for it to appear under  
		   'settings'   => 'main_color' //pick the setting it applies to
	   )
   )
);
	
$wp_customize->add_setting(
      'gradient_color1', //give it an ID
      array(
          'default' => '#E82E94', // Give it a default
      )
  );
  $wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'gradient_color1', //give it an ID
         array(
             'label'      => __( 'Verlauf Farbe 1', 'slupy' ), //set the label to appear in the Customizer
             'section'    => 'color_vars', //select the section for it to appear under  
             'settings'   => 'gradient_color1' //pick the setting it applies to
         )
     )
  );
	
  $wp_customize->add_setting(
		'gradient_color2', //give it an ID
		array(
			'default' => '#E6007E', // Give it a default
		)
	);
	$wp_customize->add_control(
	   new WP_Customize_Color_Control(
		   $wp_customize,
		   'gradient_color2', //give it an ID
		   array(
			   'label'      => __( 'Verlauf Farbe 2', 'slupy' ), //set the label to appear in the Customizer
			   'section'    => 'color_vars', //select the section for it to appear under  
			   'settings'   => 'gradient_color2' //pick the setting it applies to
		   )
	   )
	);
	
	$wp_customize->add_setting(
		  'gradient_color3', //give it an ID
		  array(
			  'default' => '#A20058', // Give it a default
		  )
	  );
	  $wp_customize->add_control(
		 new WP_Customize_Color_Control(
			 $wp_customize,
			 'gradient_color3', //give it an ID
			 array(
				 'label'      => __( 'Verlauf Farbe 3', 'slupy' ), //set the label to appear in the Customizer
				 'section'    => 'color_vars', //select the section for it to appear under  
				 'settings'   => 'gradient_color3' //pick the setting it applies to
			 )
		 )
	  );

	  



	  $wp_customize->add_setting(
		'darkColor', //give it an ID
		array(
			'default' => '#4d4d4d', // Give it a default
		)
	);
	$wp_customize->add_control(
	   new WP_Customize_Color_Control(
		   $wp_customize,
		   'darkColor', //give it an ID
		   array(
			   'label'      => __( 'Dunkle Farbe', 'slupy' ), //set the label to appear in the Customizer
			   'section'    => 'color_vars', //select the section for it to appear under  
			   'settings'   => 'darkColor' //pick the setting it applies to
		   )
	   )
	);

	
	  
	$wp_customize->add_setting(
		'lightColor', //give it an ID
		array(
			'default' => '#FBFFB', // Give it a default
		)
	);
	$wp_customize->add_control(
	   new WP_Customize_Color_Control(
		   $wp_customize,
		   'lightColor', //give it an ID
		   array(
			   'label'      => __( 'Helle Farbe', 'slupy' ), //set the label to appear in the Customizer
			   'section'    => 'color_vars', //select the section for it to appear under  
			   'settings'   => 'lightColor' //pick the setting it applies to
		   )
	   )
	);

	$wp_customize->add_setting(
	   'textColor1', //give it an ID
	   array(
		   'default' => '#ffffff', // Give it a default
	   )
   );
   $wp_customize->add_control(
	  new WP_Customize_Color_Control(
		  $wp_customize,
		  'textColor1', //give it an ID
		  array(
			  'label'      => __( 'Textfarbe 1', 'slupy' ), //set the label to appear in the Customizer
			  'section'    => 'color_vars', //select the section for it to appear under  
			  'settings'   => 'textColor1' //pick the setting it applies to
		  )
	  )
   );

   
	 
   $wp_customize->add_setting(
	   'textColor2', //give it an ID
	   array(
		   'default' => '#0a0a0a', // Give it a default
	   )
   );
   $wp_customize->add_control(
	  new WP_Customize_Color_Control(
		  $wp_customize,
		  'textColor2', //give it an ID
		  array(
			  'label'      => __( 'Textfarbe 2', 'slupy' ), //set the label to appear in the Customizer
			  'section'    => 'color_vars', //select the section for it to appear under  
			  'settings'   => 'textColor2' //pick the setting it applies to
		  )
	  )
   );

	
	
	  
	$wp_customize->add_setting(
		'linkColor', //give it an ID
		array(
			'default' => '#e6007e', // Give it a default
		)
	);
	$wp_customize->add_control(
	   new WP_Customize_Color_Control(
		   $wp_customize,
		   'linkColor', //give it an ID
		   array(
			   'label'      => __( 'Link Farbe', 'slupy' ), //set the label to appear in the Customizer
			   'section'    => 'color_vars', //select the section for it to appear under  
			   'settings'   => 'linkColor' //pick the setting it applies to
		   )
	   )
	);

	
  
}



function color_customizer_header_output() {

    ?>
    <style type="text/css">

        :root {
            --darkColor: <?php echo esc_attr( get_theme_mod( 'darkColor', '#3d3d3d' ) ); ?>;
            --lightColor: <?php echo esc_attr( get_theme_mod( 'lightColor', '#FBFBFB' ) ); ?>;
            --primaryColor: <?php echo esc_attr( get_theme_mod( 'main_color', '#E6007E' ) ); ?>;
            --gradientColor1: <?php echo esc_attr( get_theme_mod( 'gradient_color1', '#E82E94' ) ); ?>;
            --gradientColor2: <?php echo esc_attr( get_theme_mod( 'gradient_color2', '#E6007E' ) ); ?>;
            --gradientColor3: <?php echo esc_attr( get_theme_mod( 'gradient_color3', '#A20058' ) ); ?>;
            --textColor1: <?php echo esc_attr( get_theme_mod( 'textColor1', '#ffffff' ) ); ?>;
            --textColor2: <?php echo esc_attr( get_theme_mod( 'textColor2', '#0a0a0a' ) ); ?>;
            --linkColor: <?php echo esc_attr( get_theme_mod( 'linkColor', '#E6007E' ) ); ?>;
        }

    </style>
    <?php

}
add_action( 'wp_head', 'color_customizer_header_output' );



function my_customizer_styles() { ?>
	<style>
		#customize-control-main_color {
			margin: 30px 0;
		}
	</style>
	<?php

}
add_action( 'customize_controls_print_styles', 'my_customizer_styles', 999 );




add_action( 'pre_get_posts', 'joesz_include_future_posts' );
function joesz_include_future_posts( $query ) {

    if ( $query->is_main_query() && 
           ( $query->query_vars['post_type'] == 'girls' || // for single
         is_post_type_archive( 'girls' ) ) ) {         // for archive

        $query->set( 'post_status', array( 'future', 'publish' ) );

    }

}


require_once get_template_directory() . '/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'slupy_register_required_plugins' );




/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function slupy_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'CMB2', // The plugin name.
			'slug'               => 'cmb2', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/plugins/cmb2.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
            //'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
		),
        array(
			'name'               => 'Slupy Plugin', // The plugin name.
			'slug'               => 'slupy', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/plugins/slupy.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
            
        ),
        array(
			'name'               => 'Contact Form 7', // The plugin name.
			'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/plugins/contact-form-7.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
            
        ),
        array(
			'name'               => 'Cookie Law Info', // The plugin name.
			'slug'               => 'cookie-law-info', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/plugins/cookie-law-info.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
            
        ),


	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'Slupy',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'Slupy' ),
			'menu_title'                      => __( 'Install Plugins', 'Slupy' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'Slupy' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'Slupy' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'Slupy' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'Slupy'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'Slupy'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'Slupy'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'Slupy'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'Slupy'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'Slupy'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'Slupy'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'Slupy'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'Slupy'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'Slupy' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'Slupy' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'Slupy' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'Slupy' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'Slupy' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'Slupy' ),
			'dismiss'                         => __( 'Dismiss this notice', 'Slupy' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'Slupy' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'Slupy' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}
