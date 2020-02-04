<?php
/**
 * Site Identity Settings
 *
 * Register settings to hide site title and tagline in Site Identity section
 *
 * @package Ambitious
 */

/**
 * Adds Site Title settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function ambitious_customize_register_website_settings( $wp_customize ) {

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Add selective refresh for site title and description.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '.site-title a',
		'render_callback' => 'ambitious_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '.site-description',
		'render_callback' => 'ambitious_customize_partial_blogdescription',
	) );

	// Add Display Site Title Setting.
	$wp_customize->add_setting( 'ambitious_theme_options[site_title]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ambitious_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ambitious_theme_options[site_title]', array(
		'label'    => esc_html__( 'Display Site Title', 'ambitious' ),
		'section'  => 'title_tagline',
		'settings' => 'ambitious_theme_options[site_title]',
		'type'     => 'checkbox',
		'priority' => 10,
	) );

	// Add Display Tagline Setting.
	$wp_customize->add_setting( 'ambitious_theme_options[site_description]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ambitious_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'ambitious_theme_options[site_description]', array(
		'label'    => esc_html__( 'Display Tagline', 'ambitious' ),
		'section'  => 'title_tagline',
		'settings' => 'ambitious_theme_options[site_description]',
		'type'     => 'checkbox',
		'priority' => 11,
	) );
}
add_action( 'customize_register', 'ambitious_customize_register_website_settings' );

/**
 * Render the site title for the selective refresh partial.
 */
function ambitious_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function ambitious_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
