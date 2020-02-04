<?php
/**
 * Theme Color Settings
 *
 * @package Ambitious
 */

/**
 * Adds all Theme Color settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function ambitious_customize_register_theme_color_settings( $wp_customize ) {

	// Add Section for Theme Colors.
	$wp_customize->add_section( 'ambitious_section_theme_colors', array(
		'title'    => esc_html__( 'Theme Colors', 'ambitious' ),
		'priority' => 20,
		'panel'    => 'ambitious_options_panel',
	) );

	// Get Default Colors from settings.
	$default = ambitious_default_options();

	// Add Link Color setting.
	$wp_customize->add_setting( 'ambitious_theme_options[link_color]', array(
		'default'           => $default['link_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ambitious_theme_options[link_color]', array(
			'label'    => esc_html_x( 'Links', 'Color Option', 'ambitious' ),
			'section'  => 'ambitious_section_theme_colors',
			'settings' => 'ambitious_theme_options[link_color]',
			'priority' => 10,
		)
	) );

	// Add Link Hover Color setting.
	$wp_customize->add_setting( 'ambitious_theme_options[link_hover_color]', array(
		'default'           => $default['link_hover_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ambitious_theme_options[link_hover_color]', array(
			'label'    => esc_html_x( 'Link Hover', 'Color Option', 'ambitious' ),
			'section'  => 'ambitious_section_theme_colors',
			'settings' => 'ambitious_theme_options[link_hover_color]',
			'priority' => 20,
		)
	) );

	// Add Header Color setting.
	$wp_customize->add_setting( 'ambitious_theme_options[header_color]', array(
		'default'           => $default['header_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ambitious_theme_options[header_color]', array(
			'label'    => esc_html_x( 'Header', 'Color Option', 'ambitious' ),
			'section'  => 'ambitious_section_theme_colors',
			'settings' => 'ambitious_theme_options[header_color]',
			'priority' => 30,
		)
	) );

	// Add Titles Color setting.
	$wp_customize->add_setting( 'ambitious_theme_options[title_color]', array(
		'default'           => $default['title_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ambitious_theme_options[title_color]', array(
			'label'    => esc_html_x( 'Titles', 'Color Option', 'ambitious' ),
			'section'  => 'ambitious_section_theme_colors',
			'settings' => 'ambitious_theme_options[title_color]',
			'priority' => 40,
		)
	) );

	// Add Title Hover Color setting.
	$wp_customize->add_setting( 'ambitious_theme_options[title_hover_color]', array(
		'default'           => $default['title_hover_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ambitious_theme_options[title_hover_color]', array(
			'label'    => esc_html_x( 'Title Hover', 'Color Option', 'ambitious' ),
			'section'  => 'ambitious_section_theme_colors',
			'settings' => 'ambitious_theme_options[title_hover_color]',
			'priority' => 50,
		)
	) );

	// Add Footer Color setting.
	$wp_customize->add_setting( 'ambitious_theme_options[footer_color]', array(
		'default'           => $default['footer_color'],
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'ambitious_theme_options[footer_color]', array(
			'label'    => esc_html_x( 'Footer Widgets', 'Color Option', 'ambitious' ),
			'section'  => 'ambitious_section_theme_colors',
			'settings' => 'ambitious_theme_options[footer_color]',
			'priority' => 60,
		)
	) );
}
add_action( 'customize_register', 'ambitious_customize_register_theme_color_settings' );
