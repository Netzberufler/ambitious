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
	wp_enqueue_script( 'ambitious-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
	$ambitious_l10n = array(
		'expand'   => esc_html__( 'Expand child menu', 'ambitious' ),
		'collapse' => esc_html__( 'Collapse child menu', 'ambitious' ),
		'icon'     => ambitious_get_svg( 'expand' ),
	);
	wp_localize_script( 'ambitious-navigation', 'AmbitiousScreenReaderText', $ambitious_l10n );

	// Enqueue svgxuse to support external SVG Sprites in Internet Explorer.
	wp_enqueue_script( 'svgxuse', get_theme_file_uri( '/assets/js/svgxuse.min.js' ), array(), '1.2.4' );

	// Register Comment Reply Script for Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ambitious_scripts' );


/**
* Enqueue theme fonts.
*/
function ambitious_theme_fonts() {
	wp_enqueue_style( 'ambitious-theme-fonts', get_template_directory_uri() . '/assets/css/theme-fonts.css', array(), '20200212' );
}
add_action( 'wp_enqueue_scripts', 'ambitious_theme_fonts', 1 );
add_action( 'enqueue_block_editor_assets', 'ambitious_theme_fonts', 1 );


/**
 * Return SVG markup.
 *
 * @param string $icon SVG icon id.
 * @return string $svg SVG markup.
 */
function ambitious_get_svg( $icon = null ) {
	// Return early if no icon was defined.
	if ( empty( $icon ) ) {
		return;
	}

	// Create SVG markup.
	$svg  = '<svg class="icon icon-' . esc_attr( $icon ) . '" aria-hidden="true" role="img">';
	$svg .= ' <use xlink:href="' . get_parent_theme_file_uri( '/assets/icons/genericons-neue.svg#' ) . esc_html( $icon ) . '"></use> ';
	$svg .= '</svg>';

	return $svg;
}


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

}
add_action( 'widgets_init', 'ambitious_widgets_init' );


/**
 * Registers support for various Gutenberg features.
 *
 * @return void
 */
function ambitious_gutenberg_support() {

	// Add theme support for wide and full images.
	add_theme_support( 'align-wide' );

	// Add theme support for block color palette.
	add_theme_support( 'editor-color-palette', apply_filters( 'ambitious_editor_color_palette_args', array(
		array(
			'name'  => esc_html_x( 'Primary', 'block color', 'ambitious' ),
			'slug'  => 'primary',
			'color' => '#003344',
		),
		array(
			'name'  => esc_html_x( 'Secondary', 'block color', 'ambitious' ),
			'slug'  => 'secondary',
			'color' => '#268f97',
		),
		array(
			'name'  => esc_html_x( 'Accent', 'block color', 'ambitious' ),
			'slug'  => 'accent',
			'color' => '#c9493b',
		),
		array(
			'name'  => esc_html_x( 'Highlight', 'block color', 'ambitious' ),
			'slug'  => 'highlight',
			'color' => '#f9d26e',
		),
		array(
			'name'  => esc_html_x( 'White', 'block color', 'ambitious' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html_x( 'Light Gray', 'block color', 'ambitious' ),
			'slug'  => 'light-gray',
			'color' => '#e4e4e4',
		),
		array(
			'name'  => esc_html_x( 'Gray', 'block color', 'ambitious' ),
			'slug'  => 'gray',
			'color' => '#848484',
		),
		array(
			'name'  => esc_html_x( 'Dark Gray', 'block color', 'ambitious' ),
			'slug'  => 'dark-gray',
			'color' => '#242424',
		),
		array(
			'name'  => esc_html_x( 'Black', 'block color', 'ambitious' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
	) ) );

	// Add theme support for font sizes.
	add_theme_support( 'editor-font-sizes', apply_filters( 'ambitious_editor_font_sizes_args', array(
		array(
			'name' => esc_html_x( 'Small', 'block font size', 'ambitious' ),
			'size' => 16,
			'slug' => 'small',
		),
		array(
			'name' => esc_html_x( 'Medium', 'block font size', 'ambitious' ),
			'size' => 24,
			'slug' => 'medium',
		),
		array(
			'name' => esc_html_x( 'Large', 'block font size', 'ambitious' ),
			'size' => 36,
			'slug' => 'large',
		),
		array(
			'name' => esc_html_x( 'Extra Large', 'block font size', 'ambitious' ),
			'size' => 48,
			'slug' => 'extra-large',
		),
		array(
			'name' => esc_html_x( 'Huge', 'block font size', 'ambitious' ),
			'size' => 64,
			'slug' => 'huge',
		),
	) ) );
}
add_action( 'after_setup_theme', 'ambitious_gutenberg_support' );


/**
 * Enqueue block styles and scripts for Gutenberg Editor.
 */
function ambitious_block_editor_assets() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Enqueue Editor Styling.
	wp_enqueue_style( 'ambitious-editor-styles', get_theme_file_uri( '/assets/css/editor-styles.css' ), array(), $theme_version, 'all' );
}
add_action( 'enqueue_block_editor_assets', 'ambitious_block_editor_assets' );


/**
 * Remove inline styling in Gutenberg.
 *
 * @return array $editor_settings
 */
function ambitious_block_editor_settings( $editor_settings ) {
	// Remove editor styling.
	if ( ! current_theme_supports( 'editor-styles' ) ) {
		$editor_settings['styles'] = '';
	}

	return $editor_settings;
}
add_filter( 'block_editor_settings', 'ambitious_block_editor_settings', 11 );
