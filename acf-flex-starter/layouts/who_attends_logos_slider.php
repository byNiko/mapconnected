<?php
// Set slider options
$arrows = false;
$splideOptions = filter_empty_values([
	'type' => 'loop',
	'perPage' => 8,
	// 'perMove' => 2,
	'pagination' => false,
	'arrows' => $arrows,
	'autoplay' => false,
	// 'interval' => 6000,
	'pauseOnHover' => false,
	'gap' => "1rem",
	'autoScroll'=>['speed'=> ".5"],
	// 'clones'=> 0,
	'cover' => false,
	'autoWidth' => true,
	'gap' => "1rem",
	'fixedHeight' => "40px",
	"lazyLoad" => 'nearby',
	'breakpoints' => [
		"800" => [
			"perPage" => 3
		]
	],
	// 'adaptiveHeight' => $adaptive_height, // custom option to auto adjust height per slide
	// More Splide.js options can be added here
], ['pagination', 'arrows', 'pauseOnHover']); // Retain false values for these keys

$gallery = get_sub_field('icons_who_attends');

if ($gallery) : ?>
	<div class="flexible-content-wrap">
		<div class="who_attends_logos__wrapper theme--medium-1">
			<header class="text-center mb-1">
				<h2 class="h2"><?= get_sub_field('section_title'); ?></h2>
			</header>
			<div class="splide" data-splide='<?= wp_json_encode($splideOptions); ?>'>
				<div class="splide__track">
					<div class="splide__list">
						<?php
						// Loop through each slide
						foreach ($gallery as $imageID) :
							$url = wp_get_attachment_image_url($imageID, 'small');
							$alt = get_post_meta($imageID, '_wp_attachment_image_alt', true) ?: "Attending Member Log";
						?>
							<div class="splide__slide who_attends_logos-gallery-slide" >
								<?php
								echo "<img  src='". get_transparent_img_src()."' data-splide-lazy='$url' alt='$alt'/>"
								// echo "<img src='$url'  alt='$alt'/>"
								?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
endif;
