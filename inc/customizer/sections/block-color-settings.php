<?php
/**
 * Block Color Settings
 *
 * @package Ambitious
 */

/**
 * Adds all Block Color settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function ambitious_customize_register_block_color_settings( $wp_customize ) {

	// Add Section for Block Colors.
	$wp_customize->add_section( 'ambitious_section_block_colors', array(
		'title'    => esc_html__( 'Block Colors', 'ambitious' ),
		'priority' => 10,
		'panel'    => 'ambitious_options_panel',
	) );

	// Get Default Colors from settings.
	$default = ambitious_default_options();

	// Add Primary Color setting.
	$wp_customize->add_setting( 'ambitious_theme_options[primary_color]', array(
		'default'           => $default['primary_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ambitious_theme_options[primary_color]', array(
			'label'    => esc_html_x( 'Primary', 'Color Option', 'ambitious' ),
			'section'  => 'ambitious_section_block_colors',
			'settings' => 'ambitious_theme_options[primary_color]',
			'priority' => 10,
		)
	) );

	// Add Secondary Color setting.
	$wp_customize->add_setting( 'ambitious_theme_options[secondary_color]', array(
		'default'           => $default['secondary_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ambitious_theme_options[secondary_color]', array(
			'label'    => esc_html_x( 'Secondary', 'Color Option', 'ambitious' ),
			'section'  => 'ambitious_section_block_colors',
			'settings' => 'ambitious_theme_options[secondary_color]',
			'priority' => 20,
		)
	) );

	// Add Accent Color setting.
	$wp_customize->add_setting( 'ambitious_theme_options[accent_color]', array(
		'default'           => $default['accent_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ambitious_theme_options[accent_color]', array(
			'label'    => esc_html_x( 'Accent', 'Color Option', 'ambitious' ),
			'section'  => 'ambitious_section_block_colors',
			'settings' => 'ambitious_theme_options[accent_color]',
			'priority' => 30,
		)
	) );

	// Add Highlight Color setting.
	$wp_customize->add_setting( 'ambitious_theme_options[highlight_color]', array(
		'default'           => $default['highlight_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ambitious_theme_options[highlight_color]', array(
			'label'    => esc_html_x( 'Highlight', 'Color Option', 'ambitious' ),
			'section'  => 'ambitious_section_block_colors',
			'settings' => 'ambitious_theme_options[highlight_color]',
			'priority' => 40,
		)
	) );

	// Add Light Gray Color setting.
	$wp_customize->add_setting( 'ambitious_theme_options[light_gray_color]', array(
		'default'           => $default['light_gray_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ambitious_theme_options[light_gray_color]', array(
			'label'    => esc_html_x( 'Light Gray', 'Color Option', 'ambitious' ),
			'section'  => 'ambitious_section_block_colors',
			'settings' => 'ambitious_theme_options[light_gray_color]',
			'priority' => 50,
		)
	) );

	// Add Gray Color setting.
	$wp_customize->add_setting( 'ambitious_theme_options[gray_color]', array(
		'default'           => $default['gray_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ambitious_theme_options[gray_color]', array(
			'label'    => esc_html_x( 'Gray', 'Color Option', 'ambitious' ),
			'section'  => 'ambitious_section_block_colors',
			'settings' => 'ambitious_theme_options[gray_color]',
			'priority' => 60,
		)
	) );

	// Add Dark Gray Color setting.
	$wp_customize->add_setting( 'ambitious_theme_options[dark_gray_color]', array(
		'default'           => $default['dark_gray_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ambitious_theme_options[dark_gray_color]', array(
			'label'    => esc_html_x( 'Dark Gray', 'Color Option', 'ambitious' ),
			'section'  => 'ambitious_section_block_colors',
			'settings' => 'ambitious_theme_options[dark_gray_color]',
			'priority' => 70,
		)
	) );
}
add_action( 'customize_register', 'ambitious_customize_register_block_color_settings' );
