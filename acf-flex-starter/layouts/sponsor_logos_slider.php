<?php

/**
 *  get sponsorship levels from ACF Field or a template request in $args.
 * if we're ona post - get the post's sponsorship levels
 *  */

// set slider options from passed values or set to empty array
$args_slider_options = $args['slider_options'] ?? [];

// Set slider options
$splideOptions = filter_empty_values([
	'type' => 'loop',
	'perPage' => $args_slider_options['perPage'],
	// 'perMove' => 2,
	// 'rewind' => true,
	'autoWidth' => true,
	'drag'   => 'free',
	'pagination' => false,
	'arrows' => false,
	'autoplay' => false,
	// 'interval' => 2000,
	// 'clones' => 0,
	'pauseOnHover' => false,
	'autoScroll'=> ['speed'=> .25],
	// 'clone' => 10,
	'gap' => "1rem",
	'height' => "50px",
	// 'fixedHeight' => "50px",
	// 'breakpoints' => $breakpoints,
	// 'adaptiveHeight' => $adaptive_height, // custom option to auto adjust height per slide
	// More Splide.js options can be added here
], ['pagination', 'arrows', 'pauseOnHover']); // Retain false values for these keys
// print_r($splideOptions);
// print_r($args_slider_options);
$splideOptions = array_merge($splideOptions, $args_slider_options);

$sps = $args['sponsors'] ?? [];

if ($sps) : ?>
	<div class="flexible-content-wrap">
		<div class="sponsor-logos__wrapper ">
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
	</div>
<?php
endif;
