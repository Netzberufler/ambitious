<?php
/**
 * Main Navigation
 *
 * @version 1.0
 * @package Ambitious
 */
?>

<?php if ( has_nav_menu( 'primary' ) ) : ?>

	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
		<?php
		echo ambitious_get_svg( 'menu' );
		echo ambitious_get_svg( 'close' );
		?>
		<span class="menu-toggle-text"><?php esc_html_e( 'Menu', 'ambitious' ); ?></span>
	</button>

	<div class="primary-navigation">

		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'ambitious' ); ?>">

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
				)
			);
			?>
		</nav><!-- #site-navigation -->

	</div><!-- .primary-navigation -->

<?php endif; ?>
