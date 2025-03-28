<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package byniko
 */

get_header();
?>

<div class="container--narrow">
<main id="primary" class="site-main">
	<?php
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', get_post_type());

		// the_post_navigation(
		// 	array(
		// 		'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'byniko') . '</span> <span class="nav-title">%title</span>',
		// 		'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'byniko') . '</span> <span class="nav-title">%title</span>',
		// 	)
		// );

		// If comments are open or we have at least one comment, load up the comment template.
		// if (comments_open() || get_comments_number()) :
		// 	comments_template();
		// endif;

	endwhile; // End of the loop.
	?>

</main><!-- #main -->
</div>
<?php
if (byniko_has_sidebar()) {
	get_sidebar(get_post_type());
}
get_footer();
