<?php
// Set slider options
$arrows= false;
$splideOptions = filter_empty_values([
	'type' => 'loop',
		'perPage' => 8,
		// 'perMove' => 2,
		'pagination' => false,
		'arrows' => $arrows,
		'autoplay' => true,
		'interval' => 6000,
		'autoWidth' => false,
		'pauseOnHover' => false,
		'gap' => ".5rem",
		'cover' => false, 
		'autoHeight'=> false,
		'fixedHeight' => "150px",
		// 'height' => "100px",
		// "lazyLoad" => 'nearby',
	// 'breakpoints' => $breakpoints,
	// 'adaptiveHeight' => $adaptive_height, // custom option to auto adjust height per slide
	// More Splide.js options can be added here
], ['pagination', 'arrows', 'pauseOnHover']); // Retain false values for these keys

$gallery = get_sub_field('icons_who_attends');

if ($gallery) :?>
	<div class="who_attends_logos__wrapper">
		<header class="text-center">
			<h2 class="h2"><?= get_sub_field('section_title');?></h2>
		</header>
		<div class="splide" data-splide='<?= wp_json_encode($splideOptions); ?>'>
			<div class="splide__track">
				<div class="splide__list">
				<?php
					// Loop through each slide
					foreach ($gallery as $imageID) :
						$url = wp_get_attachment_image_url($imageID, 'small');
							$alt = get_post_meta($imageID, '_wp_attachment_image_alt', true)?: "Attending Member Log" ;
					?>
						<div class="splide__slide who_attends_logos-gallery-slide" style="width: 200px">
							<?php 
							
						
							// echo "<img  src='data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' data-splide-lazy='$url' alt='$alt'/>"
							echo "<img src='$url'  alt='$alt'/>"
							?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>

<?php
endif;
