<?php
load_class("Sponsorships");
load_class("Sponsor");
// Set slider options
$splideOptions = filter_empty_values([
	// 'type' => 'loop',
	'perPage' => 20,
	'perMove' => 2,
	'autoWidth' => true,
	'pagination' => false,
	'arrows' => false,
	'autoplay' => false,
	'interval' => 2000,
	'pauseOnHover' => false,
	'clone' => 10,
	'gap' => "1rem",
	// 'breakpoints' => $breakpoints,
	// 'adaptiveHeight' => $adaptive_height, // custom option to auto adjust height per slide
	// More Splide.js options can be added here
], ['pagination', 'arrows', 'pauseOnHover']); // Retain false values for these keys

/**
 *  get sponsorship levels from ACF Field or a template request in $args.
 *  */

$sponsor_levels = get_sub_field('sponsorship_types');
$sponsor_levels =
	($sponsor_levels ? $sponsor_levels : $args && $args['sponsorship_levels']) ?
	$args['sponsorship_levels'] : false;
// $sponsor_levels =
// 	(isset($sponsor_levels) ? $sponsor_levels : isset($args['sponsorship_levels']))?
// 	"test" : false;


$args = array(
	'post_type' => 'sponsor',
	'status' => 'publish',
	'tax_query' => array(
		'taxonomy' => 'Sponsor Levels',
		'field' => 'id',
		'terms' => $sponsor_levels,
	),

);

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
