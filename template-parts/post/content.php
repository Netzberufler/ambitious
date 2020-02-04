<?php
/**
 * The template for displaying articles in the loop with full content
 *
 * @version 1.0
 * @package Ambitious
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="post-header entry-header">

		<?php ambitious_post_image(); ?>

		<?php the_title( sprintf( '<h2 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php ambitious_entry_meta(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content( esc_html__( 'Continue reading', 'ambitious' ) ); ?>

	</div><!-- .entry-content -->

</article>
