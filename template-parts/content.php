<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package byniko
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if (is_singular()) :
			the_title('<h1 class="entry-title">', '</h1>');
		else :
			the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		endif;
		?>
	</header><!-- .entry-header -->

	<?php byniko_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		if (is_singular()) :
			the_content();
			else :
				the_excerpt();
	endif;

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'byniko'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php // byniko_entry_footer(); 
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->