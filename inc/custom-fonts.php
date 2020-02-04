<?php
/**
 * Custom Fonts
 *
 * Generates Custom Fonts CSS code and loads Google Fonts from Google Font API
 *
 * @package Ambitious
 */

/**
* Custom Fonts Class
*/
class Ambitious_Custom_Fonts {

	/**
	 * Actions Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Add Custom Fonts CSS code to frontend.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'add_custom_fonts_in_frontend' ), 12 );

		// Add Custom Fonts CSS code to editor.
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'add_custom_fonts_in_editor' ), 12 );

		// Add theme support for GT Typography plugin.
		add_action( 'after_setup_theme', array( __CLASS__, 'add_typography_theme_support' ) );
	}

	/**
	 * Add Font Family CSS styles in the head area of the theme.
	 */
	static function add_custom_fonts_in_frontend() {
		wp_add_inline_style( 'ambitious-stylesheet', self::get_custom_fonts_css() );
	}

	/**
	 * Add Font Family CSS styles in the head area of the Gutenberg editor.
	 */
	static function add_custom_fonts_in_editor() {
		wp_add_inline_style( 'ambitious-editor-styles', self::get_custom_fonts_css() );
	}

	/**
	 * Generate Font Family CSS styles to override default typography.
	 *
	 * @return string CSS code
	 */
	static function get_custom_fonts_css() {

		// Get Theme Options from Database.
		$theme_options = ambitious_theme_options();

		// Get Default Fonts from settings.
		$default_options = ambitious_default_options();

		// Font Variables.
		$font_variables = '';

		// Set Text Font.
		if ( $theme_options['text_font'] !== $default_options['text_font'] ) {
			$font_variables .= '--text-font: ' . self::get_font_family( $theme_options['text_font'] );
		}

		// Set Title Font.
		if ( $theme_options['title_font'] !== $default_options['title_font'] ) {
			$font_variables .= '--title-font: ' . self::get_font_family( $theme_options['title_font'] );
		}

		// Set Title Font Weight.
		if ( $theme_options['title_is_bold'] !== $default_options['title_is_bold'] ) {
			$font_variables .= '--title-font-weight: ' . ( $theme_options['title_is_bold'] ? 'bold' : 'normal' ) . '; ';
		}

		// Set Title Text Transform.
		if ( $theme_options['title_is_uppercase'] !== $default_options['title_is_uppercase'] ) {
			$font_variables .= '--title-text-transform: ' . ( $theme_options['title_is_uppercase'] ? 'uppercase' : 'none' ) . '; ';
		}

		// Set Navi Font.
		if ( $theme_options['navi_font'] !== $default_options['navi_font'] ) {
			$font_variables .= '--navi-font: ' . self::get_font_family( $theme_options['navi_font'] );
		}

		// Set Navi Font Weight.
		if ( $theme_options['navi_is_bold'] !== $default_options['navi_is_bold'] ) {
			$font_variables .= '--navi-font-weight: ' . ( $theme_options['navi_is_bold'] ? 'bold' : 'normal' ) . '; ';
		}

		// Set Navi Text Transform.
		if ( $theme_options['navi_is_uppercase'] !== $default_options['navi_is_uppercase'] ) {
			$font_variables .= '--navi-text-transform: ' . ( $theme_options['navi_is_uppercase'] ? 'uppercase' : 'none' ) . '; ';
		}

		// Return if no font variables were defined.
		if ( '' === $font_variables ) {
			return;
		}

		// Sanitize CSS Code.
		$custom_css = ':root { ' . $font_variables . '}';
		$custom_css = wp_kses( $custom_css, array( '\'', '\"' ) );
		$custom_css = str_replace( '&gt;', '>', $custom_css );
		$custom_css = preg_replace( '/\n/', '', $custom_css );
		$custom_css = preg_replace( '/\t/', '', $custom_css );

		return $custom_css;
	}

	/**
	 * Get the font family string.
	 *
	 * @param String $font Name of selected font.
	 * @return string Fonts string.
	 */
	static function get_font_family( $font ) {

		// Set System Font Stack.
		$system_fonts = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif; ';

		// Return Font Family string.
		return 'SystemFontStack' === $font ? $system_fonts : '"' . esc_html( $font ) . '", Arial, Helvetica, sans-serif; ';
	}

	/**
	 * Register support for GT Typography plugin.
	 */
	static function add_typography_theme_support() {

		// Get theme options from database.
		$theme_options = ambitious_theme_options();

		// Get selected fonts.
		$selected_fonts = array(
			$theme_options['text_font'],
			$theme_options['title_font'],
			$theme_options['navi_font'],
		);

		add_theme_support( 'gt-typography', array(
			'selected_fonts' => $selected_fonts,
		) );
	}

	/**
	 * Get available fonts
	 *
	 * @return array List of fonts.
	 */
	static function get_available_fonts() {

		$fonts = array(
			'Arial'                       => 'Arial',
			'Arial Black'                 => 'Arial Black',
			'Courier New'                 => 'Courier New',
			'Georgia'                     => 'Georgia',
			'Helvetica'                   => 'Helvetica',
			'Impact'                      => 'Impact',
			'Palatino, Palatino Linotype' => 'Palatino',
			'SystemFontStack'             => 'System Font Stack',
			'Tahoma'                      => 'Tahoma',
			'Trebuchet MS, Trebuchet'     => 'Trebuchet MS',
			'Times New Roman, Times'      => 'Times New Roman',
			'Verdana'                     => 'Verdana',
		);

		// Allow plugins to add fonts.
		$fonts = apply_filters( 'gt_typography_fonts', $fonts );

		// Sort fonts alphabetically.
		asort( $fonts );

		return $fonts;
	}
}

// Run Class.
Ambitious_Custom_Fonts::setup();
