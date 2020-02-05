<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Ambitious
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ambitious_body_classes( $classes ) {

	// Add Blog Sidebar class.
	if ( is_active_sidebar( 'sidebar-1' ) && ambitious_is_blog_page() ) {
		$classes[] = 'has-blog-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'ambitious_body_classes' );

/**
 * Check if we are on a blog page or single post.
 *
 * @return bool
 */
function ambitious_is_blog_page() {
	return ( 'post' === get_post_type() ) && ( is_home() || is_archive() || is_single() );
}
