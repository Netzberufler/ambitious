<?php
/**
 * Theme Links Control for the Customizer
 *
 * @package Ambitious
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays the theme links in the Customizer.
	 */
	class Ambitious_Customize_Links_Control extends WP_Customize_Control {
		/**
		 * Render Control
		 */
		public function render_content() {
			?>

			<div class="theme-links">

				<span class="customize-control-title"><?php esc_html_e( 'Theme Links', 'ambitious' ); ?></span>

				<p>
					<a href="<?php echo esc_url( __( 'https://germanthemes.de/en/themes/ambitious/', 'ambitious' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=ambitious&utm_content=theme-page" target="_blank">
						<?php esc_html_e( 'Theme Page', 'ambitious' ); ?>
					</a>
				</p>

				<p>
					<a href="https://demo.germanthemes.de/?demo=ambitious&utm_source=customizer&utm_campaign=ambitious" target="_blank">
						<?php esc_html_e( 'Theme Demo', 'ambitious' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://germanthemes.de/en/docs/ambitious-documentation/', 'ambitious' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=ambitious&utm_content=documentation" target="_blank">
						<?php esc_html_e( 'Theme Documentation', 'ambitious' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/ambitious/reviews/', 'ambitious' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Rate this theme', 'ambitious' ); ?>
					</a>
				</p>

			</div>

			<?php
		}
	}

endif;
