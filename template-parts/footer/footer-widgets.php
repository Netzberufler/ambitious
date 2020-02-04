<?php
/**
 * Footer Widgets
 *
 * @version 1.0
 * @package Ambitious
 */


// Check if there are footer widgets.
if ( is_active_sidebar( 'footer-column-1' )
	or is_active_sidebar( 'footer-column-2' )
	or is_active_sidebar( 'footer-column-3' )
	or is_active_sidebar( 'footer-column-4' ) ) :
	?>

	<div class="footer-widgets-background">

		<div id="footer-widgets" class="footer-widgets footer-main widget-area">

			<div class="footer-widgets-columns">

				<?php if ( is_active_sidebar( 'footer-column-1' ) ) : ?>

					<div class="footer-widget-column widget-area">
						<?php dynamic_sidebar( 'footer-column-1' ); ?>
					</div>

				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-column-2' ) ) : ?>

					<div class="footer-widget-column widget-area">
						<?php dynamic_sidebar( 'footer-column-2' ); ?>
					</div>

				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-column-3' ) ) : ?>

					<div class="footer-widget-column widget-area">
						<?php dynamic_sidebar( 'footer-column-3' ); ?>
					</div>

				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-column-4' ) ) : ?>

					<div class="footer-widget-column widget-area">
						<?php dynamic_sidebar( 'footer-column-4' ); ?>
					</div>

				<?php endif; ?>

			</div>

		</div><!-- .footer-widgets -->

	</div>

	<?php
endif;
