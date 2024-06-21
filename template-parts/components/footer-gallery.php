<?php
$gallery = get_field('footer_gallery', 'option');
if ($gallery) :
	$arrows = false;
	$splideOptions = filter_empty_values([
		'type' => 'loop',
		'perPage' => 5,
		'perMove' => 2,
		'pagination' => false,
		'arrows' => $arrows,
		'autoplay' => true,
		'interval' => 6000,
		'pauseOnHover' => false,
		'gap' => 0,
		'cover' => false, 
		'fixedHeight' => "110px",
		"lazyLoad" => 'nearby',
		'breakpoints' => [],
		// More Splide.js options can be added here
	], ['arrows', 'pagination', 'pauseOnHover']); // Retain false values for these keys
	// SVG arrow icon
	$arrowSVG = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';
?>

	<section id="footer-gallery" class="slider footer-gallery">
		<div class="splide" data-splide='<?= wp_json_encode($splideOptions); ?>'>
			<div class="splide__track">
				<ul class="splide__list">
					<?php
					// Loop through each slide
					foreach ($gallery as $imageID) :
					?>
						<li class="splide__slide footer-gallery-slide" >
							<?php 
							$url = wp_get_attachment_image_url($imageID, 'footer-gallery');
							$alt = get_post_meta($imageID, '_wp_attachment_image_alt', true)?: "Footer Gallery Image" ;
							echo "<img src='data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' data-splide-lazy='$url' alt='$alt'/>"
							?>
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
		</div>
	</section>
<?php endif; ?>