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
<style>
	.masonry-gallery {
		height: 102vh;
		position: relative;
		/* opacity: 0; */
		transition: opacity .2s;

		&.is-loaded {
			opacity: 1;
		}
	}

	.grid-item {
		opacity: 0;
		transition: opacity .2s;
		container-type: inline-size;
		position: absolute;
		padding: 1rem;
		width: calc(100%);
		min-width: min-content;

		&.is-loaded {
			opacity: 1;
		}

		@media (min-width: 768px) {
			width: 50%;
		}

		@media (min-width: 1224px) {
			width: 33.33%;
		}

		.inner {
			display: flex;
			justify-content: center;
			align-items: center;
			position: relative;
			background: var(--color-secondary-200);
			border-radius: .5rem;
			filter: drop-shadow(1px 1px 5px #ccc);
			border: 1px solid #ccc;

			img {
				margin: 2rem;
				border-radius: .5rem;
				overflow: hidden;
			}
		}

	}
</style>
<main id="primary" class="site-main">

	<div class="container">
		<?php
		if (have_posts()) :
			the_post();
			get_template_part('template-parts/content', 'page');
			if (! empty($content_items)) : ?>
				<div id="masonry-gallery" class="masonry-gallery ">

					<?php
					foreach ($content_items as $item) :
						if (is_a($item, 'Testimonial')) {
					?>
							<div class="grid-item is-testimonial">
								<?php
								echo $item->get_single_testimonial_html();
								?>
							</div>
						<?php
						} else {
						?>
							<div class="grid-item ">
								<div class="inner">
									<?php
									echo wp_get_attachment_image($item['id'], 'full');
									?>
								</div>
							</div>
					<?php
						}
					endforeach;

					?>
				</div>
		<?php
			endif;
		endif; // End of the loop.
		?>
	</div>
</main><!-- #main -->
<?php //get_sidebar('sidebar'); 
?>
<?php get_footer(); ?>
<script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script>
	const $ = jQuery;

	const items = document.querySelectorAll('.grid-item');
	// $(document).ready(function() {
	var $grid = $('.masonry-gallery').masonry({
		// options...
		itemSelector: '.grid-item',
		// fitWidth: true
	});
	// layout Masonry after each image loads
	$grid.imagesLoaded(function() {
		$grid.masonry();
		items.forEach(function($item) {
			setTimeout(function() {
				$item.classList.add('is-loaded');
			}, 1000);

		});
		// $grid.addClass('is-loaded');

	})
	// });
</script>