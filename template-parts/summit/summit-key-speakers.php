<?php
$evt = new Event($post);
$summit_post = $args['summit_post'];
$summit_obj = $args['summit_object'];
$speakers_group = get_field('speakers_group', $summit_post);
// $speakers = get_field('key_speakers', $summit_post);
$speakers = $speakers_group['key_speakers'];
$slider_id = $summit_post->post_name;

// $summit_end_date = $s->get_summit_dates_section_data('summit_end_date');



$splideOptions = filter_empty_values([
	'type' => 'slide', // loop, slide, fade - only for single slides
	'perPage' => 5,
	'perMove' => 1,
	'pagination' => false,
	'arrows' => true,
	'autoplay' => false,
	'interval' => 3000,
	'pauseOnHover' => true,
	'autoWidth' => false,
	'rewind' => false,
	'gap' => "1rem",
	'omitEnd' => false,
	'updateOnMove' => true,
	// 'clones' => 0,
	'breakpoints'=> [
		"800" => [
			'perPage' => 1
		]
	]
	// 'breakpoints' => $breakpoints,
	//'adaptiveHeight' => true, // custom option to auto adjust height per slide
	// More Splide.js options can be added here
], ['pagination', 'arrows', 'pauseOnHover']); // Retain false values for these keys
// SVG arrow icon
$arrowSVG = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';

if ($speakers) :
?>

	<div class="splide" data-splide='<?= wp_json_encode($splideOptions); ?>'>
		<div class="splide__track">
			<ul class="splide__list">
				<?php
				foreach ($speakers as $speaker) :
					$s = new Speaker($speaker);
					// invert bool hide_speaker_info_after_delay
					$hide_speaker_info = !(new Byniko())->hide_speaker_info_after_delay($summit_obj);
					$args = array(
						'include_anchor' => $hide_speaker_info,
						'show_name' => $hide_speaker_info
					);
					$html = $s->get_the_speaker_card($args);
					echo "<li class='splide__slide'>$html</li>";
				endforeach;
				?>
			</ul>
		</div>
		<!-- Navigation Arrow -->
		<div class="splide__arrows splide__arrows--ltr">
			<button class="splide__arrow splide__arrow--prev" type="button" aria-label="Previous slide" aria-controls="<?= 'splide0' . esc_attr($slider_id) . '-track'; ?>">
				<?= $arrowSVG; ?>
			</button>
			<button class="splide__arrow splide__arrow--next" type="button" aria-label="Next slide" aria-controls="<?= 'splide0' . esc_attr($slider_id) . '-track'; ?>">
				<?= $arrowSVG; ?>
			</button>
		</div>
	</div>
<?php

endif;
