<?php
/**
 * Add theme support for the Gutenberg Editor
 *
 * @package Ambitious
 */


/**
 * Registers support for various Gutenberg features.
 *
 * @return void
 */
function ambitious_gutenberg_support() {

	// Get theme options from database.
	$theme_options = ambitious_theme_options();

	// Add theme support for wide and full images.
	add_theme_support( 'align-wide' );

	// Add theme support for block color palette.
	add_theme_support( 'editor-color-palette', apply_filters( 'ambitious_editor_color_palette_args', array(
		array(
			'name'  => esc_html_x( 'Primary', 'block color', 'ambitious' ),
			'slug'  => 'primary',
			'color' => esc_html( $theme_options['primary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Secondary', 'block color', 'ambitious' ),
			'slug'  => 'secondary',
			'color' => esc_html( $theme_options['secondary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Accent', 'block color', 'ambitious' ),
			'slug'  => 'accent',
			'color' => esc_html( $theme_options['accent_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Highlight', 'block color', 'ambitious' ),
			'slug'  => 'highlight',
			'color' => esc_html( $theme_options['highlight_color'] ),
		),
		array(
			'name'  => esc_html_x( 'White', 'block color', 'ambitious' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html_x( 'Light Gray', 'block color', 'ambitious' ),
			'slug'  => 'light-gray',
			'color' => esc_html( $theme_options['light_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Gray', 'block color', 'ambitious' ),
			'slug'  => 'gray',
			'color' => esc_html( $theme_options['gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Dark Gray', 'block color', 'ambitious' ),
			'slug'  => 'dark-gray',
			'color' => esc_html( $theme_options['dark_gray_color'] ),
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

	// Enqueue Theme Settings Sidebar plugin.
	wp_enqueue_script( 'ambitious-editor-theme-settings', get_theme_file_uri( '/assets/js/editor-theme-settings.js' ), array( 'wp-blocks', 'wp-element', 'wp-edit-post' ), $theme_version );

	$theme_settings_l10n = array(
		'plugin_title'         => esc_html__( 'Theme Settings', 'ambitious' ),
		'page_options'         => esc_html__( 'Page Options', 'ambitious' ),
		'page_layout'          => esc_html__( 'Page Layout', 'ambitious' ),
		'default_layout'       => esc_html__( 'Default', 'ambitious' ),
		'full_layout'          => esc_html__( 'Full-width', 'ambitious' ),
		'hide_title'           => esc_html__( 'Hide title?', 'ambitious' ),
		'remove_bottom_margin' => esc_html__( 'Remove bottom margin?', 'ambitious' ),
	);
	wp_localize_script( 'ambitious-editor-theme-settings', 'gtThemeSettingsL10n', $theme_settings_l10n );
}
add_action( 'enqueue_block_editor_assets', 'ambitious_block_editor_assets' );


/**
 * Register Post Meta
 */
function ambitious_register_post_meta() {
	register_post_meta( 'page', 'gt_page_layout', array(
		'type'              => 'string',
		'single'            => true,
		'show_in_rest'      => true,
		'sanitize_callback' => 'sanitize_text_field',
	) );

	register_post_meta( 'page', 'gt_hide_page_title', array(
		'type'         => 'boolean',
		'single'       => true,
		'show_in_rest' => true,
	) );

	register_post_meta( 'page', 'gt_remove_bottom_margin', array(
		'type'         => 'boolean',
		'single'       => true,
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'ambitious_register_post_meta' );


/**
 * Add body classes in Gutenberg Editor.
 */
function ambitious_gutenberg_add_admin_body_class( $classes ) {
	global $post;
	$current_screen = get_current_screen();

	// Return early if we are not in the Gutenberg Editor.
	if ( ! ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) ) {
		return $classes;
	}

	// Fullwidth Page Layout?
	if ( get_post_type( $post->ID ) && 'fullwidth' === get_post_meta( $post->ID, 'gt_page_layout', true ) ) {
		$classes .= ' gt-fullwidth-page-layout ';
	}

	// Page Title hidden?
	if ( get_post_type( $post->ID ) && get_post_meta( $post->ID, 'gt_hide_page_title', true ) ) {
		$classes .= ' gt-page-title-hidden ';
	}

	// Remove bottom margin of page?
	if ( get_post_type( $post->ID ) && get_post_meta( $post->ID, 'gt_remove_bottom_margin', true ) ) {
		$classes .= ' gt-page-bottom-margin-removed ';
	}

	return $classes;
}
add_filter( 'admin_body_class', 'ambitious_gutenberg_add_admin_body_class' );


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
