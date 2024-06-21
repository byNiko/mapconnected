<?php

/**
 *  get sponsorship levels from ACF Field or a template request in $args.
 * if we're ona post - get the post's sponsorship levels
 *  */

$args_sponsr_lvls = $args['sponsorship_levels']?? [];
// set slider options from passed values or set to empty array
$args_slider_options = $args['slider_options']?? [];
// check to see if we're getting sponsorhsip levels from a passed array (get_template_part( ... args))
$sponsor_levels = get_sub_field('sponsorship_types');
$sponsor_levels =
	$sponsor_levels?: $args_sponsr_lvls?: [];


	// ($sponsor_levels ? $sponsor_levels : $args_sponsr_lvls) ?
	// $args_sponsr_lvls : false;


// $args = array(
// 	'post_type' => 'sponsor',
// 	'status' => 'publish',
// 	'tax_query' => array(
// 		'taxonomy' => 'Sponsor Levels',
// 		'field' => 'slug',
// 		'terms' => array('gold')//$sponsor_levels,
// 	),

// );
// Set slider options
$splideOptions = filter_empty_values([
	'type' => 'loop',
	'perPage' => 4,
	'perMove' => 2,
	'autoWidth' => true,
	'pagination' => false,
	'arrows' => false,
	'autoplay' => true,
	'interval' => 2000,
	'pauseOnHover' => false,
	// 'clone' => 10,
	'gap' => "2rem",
	'fixedHeight' => "30px",
	// 'breakpoints' => $breakpoints,
	// 'adaptiveHeight' => $adaptive_height, // custom option to auto adjust height per slide
	// More Splide.js options can be added here
], ['pagination', 'arrows', 'pauseOnHover']); // Retain false values for these keys
// print_r($splideOptions);
// print_r($args_slider_options);
$splideOptions = array_merge($splideOptions, $args_slider_options);

$spshps = new Sponsorships();
$sps = $spshps->get_sponsors_by_level($sponsor_levels);

if ($sps) : ?>
	<div class="sponsor-logos__wrapper">
		<div class="splide" data-splide='<?= wp_json_encode($splideOptions); ?>'>
			<div class="splide__track">
				<div class="splide__list">
					<?php
					foreach ($sps as $sp) :
						$s = new Sponsor($sp);
					?>
						<div class="splide__slide">
							<?= $s->get_logo_image(); ?>
						</div>
					<?php
					endforeach; ?>
				</div>
			</div>
		</div>
	</div>

<?php
endif;
