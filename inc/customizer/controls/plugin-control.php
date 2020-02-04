<?php
/**
 * Plugin Control for the Customizer
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
	class Ambitious_Customize_Plugin_Control extends WP_Customize_Control {
		/**
		 * Render Control
		 */
		public function render_content() {
			?>

			<label class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</label>

			<span class="textfield">
				<?php echo esc_html( $this->description ); ?>
			</span>

			<p>
				<a href="<?php echo esc_url( network_admin_url( 'plugin-install.php?tab=search&type=author&s=germanthemes' ) ); ?>" class="button button-primary">
					<?php esc_html_e( 'Install Plugin', 'ambitious' ); ?>
				</a>
			</p>

			<?php
		}
	}

endif;
