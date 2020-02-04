<?php
/**
 * The sidebar containing the widget area on blog pages.
 *
 * @package Ambitious
 */

// Check if Blog Sidebar has widgets.
if ( is_active_sidebar( 'sidebar-1' ) && ambitious_is_blog_page() ) : ?>

	<section id="secondary" class="sidebar widget-area" role="complementary">

		<?php dynamic_sidebar( 'sidebar-1' ); ?>

	</section><!-- #secondary -->

	<?php
endif;
