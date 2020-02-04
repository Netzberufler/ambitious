<?php
/**
 * Theme Info Settings
 *
 * Register Theme Info Settings
 *
 * @package Ambitious
 */

/**
 * Adds all Theme Info settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function ambitious_customize_register_theme_info_settings( $wp_customize ) {

	// Add Section for Theme Fonts.
	$wp_customize->add_section( 'ambitious_section_theme_info', array(
		'title'    => esc_html__( 'Theme Info', 'ambitious' ),
		'priority' => 200,
		'panel'    => 'ambitious_options_panel',
	) );

	// Add Theme Links control.
	$wp_customize->add_control( new Ambitious_Customize_Links_Control(
		$wp_customize, 'ambitious_theme_links', array(
			'section'  => 'ambitious_section_theme_info',
			'settings' => array(),
			'priority' => 10,
		)
	) );

	// Add GT Local Fonts control.
	if ( ! class_exists( 'GermanThemes_Blocks' ) ) {
		$wp_customize->add_control( new Ambitious_Customize_Plugin_Control(
			$wp_customize, 'gt_blocks_plugin', array(
				'label'       => esc_html__( 'GT Blocks', 'ambitious' ),
				'description' => esc_html__( 'Install our free GT Blocks plugin to create a business-styled homepage in the Editor with just a few clicks.', 'ambitious' ),
				'section'     => 'ambitious_section_theme_info',
				'settings'    => array(),
				'priority'    => 30,
			)
		) );
	}
}
add_action( 'customize_register', 'ambitious_customize_register_theme_info_settings' );
