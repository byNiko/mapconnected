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
	endwhile; // End of the loop.
	?>

</main><!-- #main -->
</div>
<?php
if (byniko_has_sidebar()) {
	get_sidebar(get_post_type());
}
get_footer();
