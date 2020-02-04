<?php
/**
 * Footer Copyright
 *
 * @version 1.0
 * @package Ambitious
 */


// Check if there are footer copyright widgets.
if ( is_active_sidebar( 'footer-copyright' ) ) :
	?>

	<div class="footer-copyright-background">

		<div id="footer-copyright" class="footer-copyright footer-main widget-area">

			<?php dynamic_sidebar( 'footer-copyright' ); ?>

		</div><!-- .footer-copyright -->

	</div>

	<?php
endif;
