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
		.masonry-gallery {
			position: relative;
		}

		.grid-item {
			position: absolute;
			padding: 1rem;
			width: 31.4%;
			background: orange;

			@media (max-width: 768px) {
				width: 100%;
				position: initial;
				margin-bottom: 1rem;

				&:last-of-type {
					margin-bottom: 0;
				}
			}

			h3 {
				margin: 0 0 1rem;
				border-bottom: 1px solid white;
				text-align: left;
				font-size: 24px;
			}
		}
	</style>
	<div class="container">
		<?php
		if (have_posts()) :
			the_post();
			the_title("<h1 class='page-title'>", "</h1>");
			get_template_part('template-parts/content', 'page');
			if (! empty($content_items)) : ?>
				<div id="masonry-gallery" class="masonry-gallery ">
					<div class="grid-sizer"></div>
					<div class="grid-item"></div>
					<?php
					$width_classes = [
						'grid-item--width2',
						'grid-item--width3',
						'grid-item--width4',
					];
					$height_classes = [
						'grid-item--height2',
						'grid-item--height3',
						'grid-item--height4',
					];
					foreach ($content_items as $item) :
						$rand_height = array_rand($height_classes, 1);
						$rand_width = array_rand($width_classes, 1);
						if (is_a($item, 'Testimonial')) {
					?>
							<div class="grid-item <?= $height_classes[$rand_width]; ?> <?= $height_classes[$rand_height]; ?>">
								<?php
								echo $t->get_single_testimonial_html();
								?>
							</div>
						<?php
						} else {
						?>
							<div class="grid-item <?= $height_classes[$rand_width]; ?> <?= $height_classes[$rand_height]; ?>">
								<?php
								echo wp_get_attachment_image($item['id'], 'full');
								?>
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
	var colCount = 0;
	var colWidth = 0;
	var windowWidth = 0;
	var blocks = [];
	const $ = jQuery;

	function positionBlocks() {

		$('.grid-item').each(function() {
			var min = Array.min(blocks),
				index = $.inArray(min, blocks),
				leftPos = margin + (index * (colWidth + margin));
			$(this).css({
				'left': leftPos + 'px',
				'top': min + 'px'
			});
			blocks[index] = min + $(this).outerHeight() + margin;
		});
	}

	function setupBlocks() {
		windowWidth = $('.masonry-gallery').width();
		console.log(windowWidth);
		if (windowWidth <= 768) {
			return;
		}
		colWidth = $('.grid-item').outerWidth();
		margin = (windowWidth - colWidth * 3) / 4;
		blocks = [];
		colCount = Math.floor(windowWidth / (colWidth + margin));
		for (var i = 0; i < colCount; i++) {
			blocks.push(margin);
		}
		positionBlocks();
		$('.masonry-gallery').height(Array.max(blocks));
	}

	$(function() {
		$(window).resize(setupBlocks);
	});

	// Function to get the Min value in Array
	Array.min = function(array) {
		return Math.min.apply(Math, array);
	};
	// Function to get the Max value in Array
	Array.max = function(array) {
		return Math.max.apply(Math, array);
	};

	$(document).ready(function() {
		setupBlocks();
	});
</script>