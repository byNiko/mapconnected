<?php
$summit_post = $args['summit_post'];
$speakers = get_field('key_speakers', $summit_post);

$splideOptions = filter_empty_values([
	'type' => 'loop', // loop, slide, fade - only for single slides
	'perPage' => 8,
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
	// 'breakpoints' => $breakpoints,
	//'adaptiveHeight' => true, // custom option to auto adjust height per slide
	// More Splide.js options can be added here
], ['pagination', 'arrows', 'pauseOnHover']); // Retain false values for these keys
// SVG arrow icon
$arrowSVG = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';

if ($speakers) :
?>

	<section id="key-speakers" class="key-speakers">
		<div class="container--narrow">
			<h2 class="h2 fz-xxl">Key Speakers</h2>
			<div class="splide" data-splide='<?= wp_json_encode($splideOptions); ?>'>
				<div class="splide__track">
					<ul class="splide__list">
						<?php
						foreach ($speakers as $speaker) :
							$s = new Speaker($speaker);
							$html = $s->get_the_speaker_card();
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
		</div>
	</section>
<?php

endif;
