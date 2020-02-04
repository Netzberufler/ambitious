<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @version 1.0
 * @package Ambitious
 */

get_header();

if ( have_posts() ) :

	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/page/content', 'page' );

	endwhile;

	ambitious_pagination();

else :

	get_template_part( 'template-parts/page/content', 'none' );

endif;

get_footer();
