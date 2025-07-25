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
	.loading {
		text-align: center;
		position: absolute;
		top: 5cqh;
		/* left: 50%; */
		/* transform: translateX(-50%); */
		font-size: var(--font-size--lg);
		width: 100%;
		margin-top: 2rem;
		display: flex;
		justify-content: center;
		/* align-items: center; */
	}

	.is-loaded .loading {
		display: none;
	}

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
		transform: translatey(20px);
		transition: opacity .5s ease-in-out, transform .5s ease-in-out;
		container-type: inline-size;
		position: absolute;
		padding: 1rem;
		width: calc(100%);
		min-width: min-content;

		&.animate-in {
			opacity: 1;
			transform: translatey(0);
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
					<div class="loading">
						...loading
					</div>
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
	const $container = $('.masonry-gallery');

	const $grid = $container.masonry({
		// options...
		itemSelector: '.grid-item',
	});
	// layout Masonry after each image loads
	$grid.imagesLoaded(function() {
		$grid.masonry();
		$container.addClass('is-loaded');
		let count = 0;
		items.forEach(function($item, index) {
			const delay = index * 200;
			setTimeout(function() {
				$item.classList.add('is-loaded');
			}, delay);

		})
	})
</script>

<script>
	function watchElementsOnScreen(selector, callback, options = {}) {
		// Check if IntersectionObserver is supported by the browser
		if (!('IntersectionObserver' in window)) {
			console.warn('IntersectionObserver is not supported by this browser. Elements will not be observed.');
			// Fallback: Just execute the callback for all elements immediately if not supported
			document.querySelectorAll(selector).forEach(element => {
				callback(element, {
					isIntersecting: true,
					intersectionRatio: 1
				});
			});
			return;
		}

		// Create a new IntersectionObserver instance
		const observer = new IntersectionObserver((entries, observerInstance) => {
			entries.forEach(entry => {
				// Call the provided callback function for each entry
				// Pass the element and the entry object
				callback(entry.target, entry);
			});
		}, options); // Pass the optional configuration to the observer

		// Select all elements matching the given selector
		const elementsToObserve = document.querySelectorAll(selector);

		// Start observing each selected element
		elementsToObserve.forEach(element => {
			observer.observe(element);
		});

		// Return the observer instance so it can be used to unobserve elements later if needed
		return observer;
	}

	// You would typically call this function in your script after the DOM is loaded,
	// for example, within a 'DOMContentLoaded' event listener:

	document.addEventListener('DOMContentLoaded', () => {
	  // Example usage:
	  const observer = watchElementsOnScreen('.grid-item', (element, entry) => {
	    if (entry.isIntersecting) {
	      element.classList.add('animate-in'); // Add a class to trigger CSS animation
	      // If you only want to animate once, you can unobserve:
	      // observer.unobserve(element);
	    } else {
	      // console.log(`${element.id || element.tagName} is no longer visible.`);
	      // element.classList.remove('animate-in'); // If you want to reset animation
	    }
	  }, {
	    rootMargin: '0px', // No margin around the viewport
	    threshold: 0.2 // Trigger when 20% of the element is visible
	  });
	});
</script>