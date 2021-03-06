<?php
/**
 * Blunderbus functions and definitions
 *
 * @package Blunderbus
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( 'blunderbus_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function blunderbus_setup() {
	global $cap, $content_width;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	if ( function_exists( 'add_theme_support' ) ) {

		/**
		 * Add default posts and comments RSS feed links to head
		*/
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );

		/**
		 * Enable support for Post Formats
		*/
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/**
		 * Setup the WordPress core custom background feature.
		*/
		add_theme_support( 'custom-background', apply_filters( 'blunderbus_custom_background_args', array(
			'default-color' => '#fffdf9',
			'default-image' => '',
		) ) );

	}

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Blunderbus, use a find and replace
	 * to change 'blunderbus' to the name of your theme in all the template files
	*/
	load_theme_textdomain( 'blunderbus', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header bottom menu', 'blunderbus' ),
	) );

}
endif; // blunderbus_setup
add_action( 'after_setup_theme', 'blunderbus_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function blunderbus_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Widget Area', 'blunderbus' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Grand Canyon Survey Widget Area', 'blunderbus' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Manual of Geodetic Triangulation Widget Area', 'blunderbus' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Footer Widget 1',
		'id' => 'footer-sidebar-1',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		register_sidebar( array(
		'name' => 'Footer Widget 2',
		'id' => 'footer-sidebar-2',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		register_sidebar( array(
		'name' => 'Footer Widget 3',
		'id' => 'footer-sidebar-3',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		register_sidebar(array(
		'name'=> 'My Slider Widget Area',
		'id' => 'custom-slider'
		));
		register_sidebar(array(
		'name'=> 'My Custom Widget Area',
		'id' => 'custom'
		));
		register_sidebar(array(
		'name'=> 'My About Widget Area',
		'id' => 'custom-about'
		));
}
add_action( 'widgets_init', 'blunderbus_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function blunderbus_scripts() {

        // Import the necessary TK Bootstrap WP CSS additions
	wp_enqueue_style( 'blunderbus-bootstrap-wp', get_template_directory_uri() . '/includes/css/bootstrap-wp.css' );
	// load bootstrap css
	wp_enqueue_style( 'blunderbus-bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.min.css' );



	// load Font Awesome css
	wp_enqueue_style( 'blunderbus-font-awesome', get_template_directory_uri() . '/includes/css/font-awesome.min.css', false, '4.1.0' );

        // load Blunderbus styles
	wp_enqueue_style( 'blunderbus-style', get_stylesheet_uri() );

	// load bootstrap js
	wp_enqueue_script('blunderbus-bootstrapjs', get_template_directory_uri().'/includes/resources/bootstrap/js/bootstrap.min.js', array('jquery'), true );

	// load bootstrap wp js
	wp_enqueue_script( 'blunderbus-bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( 'blunderbus-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'blunderbus-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', 'blunderbus_scripts' );

/** Add search form to menu **/

add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);

 function add_search_form($items, $args) {
          if( $args->theme_location == 'primary' )
          $items .= '<li class="search">'.get_search_form(false).'</li>';
     return $items;
}

/** Add Read More link to excerpts

function excerpt_read_more_link($output) {
 global $post;
 return $output . '<a href="'. get_permalink($post->ID) . '"> Read More...</a>';
}
add_filter('the_excerpt', 'excerpt_read_more_link');
**/

/** Prevent compression of JPGs **/

add_filter('jpeg_quality', function($arg){return 100;});

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';

/**
 * Load responsive tabs.
 */
function my_responsive_tabs() {
	wp_enqueue_script(
		'custom-script',
		get_stylesheet_directory_uri() . '/includes/js/responsive-tabs.js',
		array( 'jquery' )
	);
}

add_action( 'wp_enqueue_scripts', 'my_responsive_tabs' );

require_once("google-map.php");

/**
 * Enable excerpts for pages.
 */

function my_add_excerpts_to_pages() {
     add_post_type_support('page', 'excerpt');
}
add_action('init', 'my_add_excerpts_to_pages');



