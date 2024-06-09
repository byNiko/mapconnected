<?php
load_class('Testimonial');
// $args are from get_template_part include
// print_r($args['template_args']);
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
// print_r($posts);
// $query = $args['query'];

// $slider_id = get_query_var('slider_id', 'default-slider-id');

// Set slider options
$splideOptions = filter_empty_values([
	'type' => 'slide', // loop, slide, fade - only for single slides
	'perPage' => 3,
	'perMove' => 1,
	'pagination' => true,
	'arrows' => true,
	'autoplay' => false,
	'interval' => 3000,
	'pauseOnHover' => true,
	'rewind' => false,
	'gap' => "2rem",
	'omitEnd' => false,
	'updateOnMove' => true,
	// 'breakpoints' => $breakpoints,
	//'adaptiveHeight' => true, // custom option to auto adjust height per slide
	// More Splide.js options can be added here
], ['pagination', 'arrows', 'pauseOnHover']); // Retain false values for these keys

// SVG arrow icon
$arrowSVG = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';
?>
<?php if ($posts) : ?>
	<section class="slider testimonial-slider">
		<div class="container">
			<div class="splide" data-splide='<?= wp_json_encode($splideOptions); ?>'>
				<div class="splide__track">
					<ul class="splide__list">
						<?php foreach($posts as $p): ?>
							<?php $t = new Testimonial($p); ?>
							<li class="splide__slide">
								<div class="testimonial-card testimonial-slider--item d-flex">
									<div class="testimonial-card__quote-wrapper">
										<q><?= $t->get_short_quote(); ?></q>
										<cite> <?= $t->get_name();  ?></cite>
										<cite> <?= $t->get_title();  ?></cite>
										<cite> <?= $t->get_company();  ?></cite>										
										<cite class="testimonial-card__logo-wrapper"> <?= $t->get_company_logo_image();   ?></cite>										

									</div>
									<div class="testimonials-card__image-wrapper">
										<?php if ($t->get_has_video() && $video_url = $t->get_video_url()) {
											// wrap image in play button 
											// and create popover to play video
											echo " has video";
										} ?>
										<?php if ($vertImage = $t->get_vertical_image())
											echo wp_get_attachment_image($vertImage['id'], 'medium'); ?>
									</div>
								</div>
							</li>
						<?php endforeach; ?>

					</ul>
				</div>
			</div>
		</div>
	</section>

<?php 
endif;