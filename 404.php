<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @version 1.0
 * @package Ambitious
 */

get_header(); ?>

	<section class="error-404 not-found type-page">

		<header class="entry-header">

			<h1 class="entry-title page-title"><?php esc_html_e( '404: Page not found', 'ambitious' ); ?></h1>

		</header><!-- .entry-header -->

		<div class="entry-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search or one of the links below?', 'ambitious' ); ?></p>

			<?php get_search_form(); ?>

			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

			<?php the_widget( 'WP_Widget_Pages' ); ?>

		</div><!-- .entry-content -->

	</section><!-- .error-404 -->

<?php
get_footer();
