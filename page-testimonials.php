<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package byniko
 */

get_header();
$gallery_page = get_page_by_path('gallery');
$gallery_items = get_field('gallery_group', $gallery_page);

$args = array(
	'posts_per_page' => -1,
	'post_type' => 'testimonial',
	'status' => 'publish',
	'orderby'        => 'rand'
);
$testimonials = new WP_Query($args);

$content_items = [];

if ($testimonials->have_posts()) :
	while ($testimonials->have_posts()) :
		$testimonials->the_post();
		$t = new Testimonial($post);
		$content_items[] = $t;
	endwhile;
	wp_reset_postdata(); // Restore original post data
endif;

foreach ($gallery_items as $item) :
	$content_items[] = [
		'content_type' => 'image',
		'id' => $item
	];
endforeach;
// var_dump($content_items);
shuffle($content_items);
?>
<main id="primary" class="site-main">
	<style>
		.testimonial-image-grid {
			display: flex;
			flex-wrap: wrap;
			gap: 1rem;
			& > * {
				width: 30%;
			}
			img {
				width: 50%;
				object-fit:cover;
			}
		}
	</style>
	<div class="container">
		<?php
		while (have_posts()) :
			the_post();
			the_title("<h1 class='page-title'>", "</h1>");
			get_template_part('template-parts/content', 'page');
			if (! empty($content_items)) : ?>
				<div class="testimonial-image-grid">
					<?php
					foreach ($content_items as $item) {
						if (is_a($item, 'Testimonial')) {
							echo $t->get_single_testimonial_html();
						} else {
							echo wp_get_attachment_image($item['id'], 'medium');
						}
					}
					?>
				</div>
		<?php
			endif;
		// If comments are open or we have at least one comment, load up the comment template.
		// if (comments_open() || get_comments_number()) :
		// 	comments_template();
		// endif;

		endwhile; // End of the loop.
		?>
	</div>
</main><!-- #main -->
<?php //get_sidebar('sidebar'); 
?>
<?php get_footer(); ?>