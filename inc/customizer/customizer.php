<?php
/**
 * Implement theme options in the Customizer
 *
 * @package Ambitious
 */

// Load Sanitize Functions.
require( get_template_directory() . '/inc/customizer/sanitize-functions.php' );

// Load Custom Controls.
require( get_template_directory() . '/inc/customizer/controls/font-control.php' );
require( get_template_directory() . '/inc/customizer/controls/headline-control.php' );
require( get_template_directory() . '/inc/customizer/controls/links-control.php' );
require( get_template_directory() . '/inc/customizer/controls/plugin-control.php' );

// Load Customizer Sections.
require( get_template_directory() . '/inc/customizer/sections/website-settings.php' );
require( get_template_directory() . '/inc/customizer/sections/blog-settings.php' );
require( get_template_directory() . '/inc/customizer/sections/block-color-settings.php' );
require( get_template_directory() . '/inc/customizer/sections/theme-color-settings.php' );
require( get_template_directory() . '/inc/customizer/sections/typography-settings.php' );
require( get_template_directory() . '/inc/customizer/sections/theme-info-settings.php' );

/**
 * Registers Theme Options panel and sets up some WordPress core settings
 *
 * @param object $wp_customize / Customizer Object.
 */
function ambitious_customize_register_options( $wp_customize ) {

	// Add Theme Options Panel.
	$wp_customize->add_panel( 'ambitious_options_panel', array(
		'priority'       => 180,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'ambitious' ),
	) );

	// Change default background section.
	$wp_customize->get_control( 'background_color' )->section = 'background_image';
	$wp_customize->get_section( 'background_image' )->title   = esc_html__( 'Background', 'ambitious' );
}
add_action( 'customize_register', 'ambitious_customize_register_options' );


/**
 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
 */
function ambitious_customize_preview_js() {
	wp_enqueue_script( 'ambitious-customize-preview', get_template_directory_uri() . '/assets/js/customize-preview.min.js', array( 'customize-preview' ), '20191125', true );

	// Load Custom Fonts from GT Local Fonts plugin in Customizer Preview if plugin is active.
	if ( class_exists( 'GermanThemes_Local_Fonts' ) ) {
		$font_settings = array(
			'pluginURL' => WP_PLUGIN_URL . '/gt-local-fonts/assets/css/',
		);
		wp_localize_script( 'ambitious-customize-preview', 'AmbitiousFontSettings', $font_settings );
	}
}
add_action( 'customize_preview_init', 'ambitious_customize_preview_js' );


/**
 * Embed JS for Customizer Controls.
 */
function ambitious_customizer_controls_js() {
	wp_enqueue_script( 'ambitious-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls.min.js', array(), '20190722', true );
}
add_action( 'customize_controls_enqueue_scripts', 'ambitious_customizer_controls_js' );


/**
 * Embed CSS styles Customizer Controls.
 */
function ambitious_customizer_controls_css() {
	wp_enqueue_style( 'ambitious-customizer-controls', get_template_directory_uri() . '/assets/css/customizer-controls.css', array(), '20191125' );
}
add_action( 'customize_controls_print_styles', 'ambitious_customizer_controls_css' );
