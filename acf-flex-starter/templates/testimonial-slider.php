<?php
$slider_id = '';
$arrows = true;
$pagination = false;
$query_args = array(
	'posts_per_page' => 15,
	'post_type' => 'testimonial',
	'post_status' => 'publish',
	'orderby'        => 'rand',
	'post__not_in' => $_SESSION['testimonials_on_page'],
	'tax_query' => array(
		array(
			'taxonomy' => 'testimonial-type',
			'field' => 'name',
			'terms' => 'Brand Member',
		)
	),
);
$posts = get_posts($query_args);
// Set slider options
$splideOptions = filter_empty_values([
	'type' => 'slide', // loop, slide, fade - only for single slides
	'perPage' => 4,
	'perMove' => 1,
	'pagination' => $pagination,
	'arrows' => $arrows,
	'autoplay' => false,
	'interval' => 5000,
	'pauseOnHover' => true,
	'rewind' => false,
	'gap' => "2rem",
	'omitEnd' => false,
	'updateOnMove' => true,
	'adaptiveHeight' => false, // custom option to auto adjust height per slide
	'breakpoints' => [
		'1600' => [
			'perPage' => 3,
			// 'autoplay' => true
			// 'destroy'=> true,
		],
		'1180' => [
			'perPage' => 2,
			// 'autoplay' => true
			// 'destroy'=> true,
		],
		'800' => [
			'perPage' => 1,
			// 'autoplay' => true
			// 'destroy'=> true,
		]
	]
	// 'breakpoints' => $breakpoints,
	// More Splide.js options can be added here
], ['pagination', 'arrows', 'pauseOnHover']); // Retain false values for these keys

// SVG arrow icon
$arrowSVG = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';
?>
<?php if ($posts) : ?>
	<div class="flexible-content-wrap">
		<div class="slider testimonial-slider">
			<?php if ($headings = get_sub_field('headings')) : ?>
				<div class="container--narrow">
					<?php get_template_part('/acf-flex-starter/layouts/headings'); ?>
				</div>
			<?php endif; ?>
			<div class="container">
				<div class="splide" data-splide='<?= wp_json_encode($splideOptions); ?>'>
					<div class="splide__track">
						<ul class="splide__list">
							<?php foreach ($posts as $p) : ?>
								<?php
								$t = new Testimonial($p);
								$video_url = $t->get_video_url();
								?>
								<li class="splide__slide <?= $video_url ? "has-video" : null; ?>">
									<div class="testimonial-slider--item  <?= $video_url ? "has-video" : null; ?> ">
										<?= $t->get_single_testimonial_html(); ?>
									</div>
								</li>
							<?php endforeach; ?>

						</ul>
					</div>
					<?php if ($arrows) : ?>
						<!-- Navigation Arrow -->
						<div class="splide__arrows splide__arrows--ltr">
							<button class="splide__arrow splide__arrow--prev" type="button" aria-label="Previous slide" aria-controls="<?= 'splide0' . esc_attr($slider_id) . '-track'; ?>">
								<?= $arrowSVG; ?>
							</button>
							<button class="splide__arrow splide__arrow--next" type="button" aria-label="Next slide" aria-controls="<?= 'splide0' . esc_attr($slider_id) . '-track'; ?>">
								<?= $arrowSVG; ?>
							</button>
						</div>
					<?php endif; ?>

					<?php if ($pagination) : ?>
						<!-- Pagination Dots -->
						<ul class="splide__pagination"></ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php endif;
