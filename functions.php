<?php
/**
 * Ambitious functions and definitions
 *
 * @package Ambitious
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ambitious_setup() {

	// Make theme available for translation.
	load_theme_textdomain( 'ambitious', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Set default Post Thumbnail size.
	set_post_thumbnail_size( 800, 500, true );

	// Add image size for header image on single posts and pages.
	add_image_size( 'ambitious-header-image', 9999, 640, true );

	// Register Navigation Menus.
	register_nav_menus( array(
		'primary' => esc_html__( 'Main Navigation', 'ambitious' ),
	) );

	// Switch default core markup for galleries and captions to output valid HTML5.
	add_theme_support( 'html5', array(
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom logo feature.
	add_theme_support( 'custom-logo', apply_filters( 'ambitious_custom_logo_args', array(
		'height'      => 60,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
	) ) );

	// Set up the WordPress core custom header feature.
	add_theme_support( 'custom-header', apply_filters( 'ambitious_custom_header_args', array(
		'header-text' => false,
		'width'       => 1920,
		'height'      => 640,
	) ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ambitious_custom_background_args', array(
		'default-color' => 'ffffff',
	) ) );

	// Add Theme Support for Selective Refresh in Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'ambitious_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ambitious_content_width() {

	// Default content width.
	$content_width = 800;

	// Fullwidth content width.
	if ( is_page() && 'fullwidth' === get_post_meta( get_the_ID(), 'gt_page_layout', true ) ) {
		$content_width = 1280;
	}

	// Set global variable for content width.
	$GLOBALS['content_width'] = apply_filters( 'ambitious_content_width', $content_width );
}
add_action( 'after_setup_theme', 'ambitious_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function ambitious_scripts() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Register and Enqueue Stylesheet.
	wp_enqueue_style( 'ambitious-stylesheet', get_stylesheet_uri(), array(), $theme_version );

	// Register and enqueue navigation.js.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script( 'ambitious-navigation', get_theme_file_uri( '/assets/js/navigation.min.js' ), array( 'jquery' ), '1.0', true );
		$ambitious_l10n = array(
			'expand'   => esc_html__( 'Expand child menu', 'ambitious' ),
			'collapse' => esc_html__( 'Collapse child menu', 'ambitious' ),
			'icon'     => ambitious_get_svg( 'expand' ),
		);
		wp_localize_script( 'ambitious-navigation', 'AmbitiousScreenReaderText', $ambitious_l10n );
	}

	// Enqueue svgxuse to support external SVG Sprites in Internet Explorer.
	wp_enqueue_script( 'svgxuse', get_theme_file_uri( '/assets/js/svgxuse.min.js' ), array(), '1.2.4' );

	// Register Comment Reply Script for Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ambitious_scripts' );


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function ambitious_widgets_init() {

	// Register Blog Sidebar widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'ambitious' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html_x( 'Appears on blog pages and single posts.', 'widget area description', 'ambitious' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class = "widget-title">',
		'after_title'   => '</h3>',
	) );

	// Register Footer Column 1 widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'ambitious' ),
		'id'            => 'footer-column-1',
		'description'   => esc_html_x( 'Appears in the first column in footer.', 'widget area description', 'ambitious' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class = "widget-title">',
		'after_title'   => '</h4>',
	) );

	// Register Footer Column 2 widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'ambitious' ),
		'id'            => 'footer-column-2',
		'description'   => esc_html_x( 'Appears in the second column in footer.', 'widget area description', 'ambitious' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class = "widget-title">',
		'after_title'   => '</h4>',
	) );

	// Register Footer Column 3 widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'ambitious' ),
		'id'            => 'footer-column-3',
		'description'   => esc_html_x( 'Appears in the third column in footer.', 'widget area description', 'ambitious' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class = "widget-title">',
		'after_title'   => '</h4>',
	) );

	// Register Footer Column 4 widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'ambitious' ),
		'id'            => 'footer-column-4',
		'description'   => esc_html_x( 'Appears in the fourth column in footer.', 'widget area description', 'ambitious' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class = "widget-title">',
		'after_title'   => '</h4>',
	) );

	// Register Footer Copyright widget area.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Copyright', 'ambitious' ),
		'id'            => 'footer-copyright',
		'description'   => esc_html_x( 'Appears in the bottom footer line.', 'widget area description', 'ambitious' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class = "widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'ambitious_widgets_init' );


/**
 * Include Files
 */

// Include Customizer Options.
require get_template_directory() . '/inc/customizer/default-options.php';

// Include SVG Icon Functions.
require get_template_directory() . '/inc/icons.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-functions.php';

// Include Template Tags.
require get_template_directory() . '/inc/template-tags.php';

// Include Gutenberg Features.
require get_template_directory() . '/inc/gutenberg.php';
