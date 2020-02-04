<?php
/**
 * The template for displaying single posts
 *
 * @version 1.0
 * @package Ambitious
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="post-header entry-header">

		<?php ambitious_post_image(); ?>

		<?php the_title( '<h1 class="post-title entry-title">', '</h1>' ); ?>

		<?php ambitious_entry_meta(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
		<?php ambitious_entry_tags(); ?>

	</div><!-- .entry-content -->

</article>
