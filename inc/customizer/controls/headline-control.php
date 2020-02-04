<?php
/**
 * Headline Control for the Customizer
 *
 * @package Ambitious
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays a bold label text. Used to create headlines for radio buttons and description sections.
	 */
	class Ambitious_Customize_Header_Control extends WP_Customize_Control {
		/**
		 * Render Control
		 */
		public function render_content() {
			?>

			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			</label>

			<?php
		}
	}

endif;
