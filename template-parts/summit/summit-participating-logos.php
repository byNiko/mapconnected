<?php

if ($attending_group = get_field('attending_companies_group')) :

	$show_current = $attending_group['show_current_or_past_attenddees']?? false;

	$attending_logos = $show_current ?  $attending_group['attending_company_logos']: get_field('past_attendees_logos', 'options') ;
	if (count($attending_logos) > 0) :
		$logo_limit = $attending_group['limit'];
		$title = $attending_group['title'];
		$button_text = $attending_group['view_all_logos_button_text'];

?>
		<section id="participating-logos" class="theme--medium-1 no-padding">
			<div class="container">
				<header class="text-center my-4">
					<h2 class="h1 text-underline"><?= $title; ?> </h2>
					<hr>
				</header>
				<div id="attendee-gallery" class="flex-gallery">
					<?php
					$count = 0;
					$logo_html_array = [];
					$icon_pattern = '<div class="flex-gallery__item fade_in_up"> %s </div>';
					$logo_html_array = array_map(function($image){
						return wp_sprintf(
							'<div class="flex-gallery__item fade_in_up"> %s </div>',
							wp_get_attachment_image($image, 'medium', false, ['loading' => 'lazy'])
						);
					},$attending_logos);

					foreach ($logo_html_array as $logo) :
						$count++;
						if ($logo_limit < $count) break;
						echo $logo;
					endforeach;
					?>
				</div>
			</div>
			<footer class="text-center mt-4">
			<?php
			$gallery_pattern = '<div class="logo-gallery"> %s </div>';
			$all_logos = array_reduce($logo_html_array, function ($carry, $item) {
				$carry .= $item;
				return $carry;
			}, $carry = '');

			$logos_wrapper = wp_sprintf(
				$gallery_pattern,
				$all_logos
			);

			$modal = new Modal('participating-logos-modal', $title, $logos_wrapper);
			?>
		
				<?= $modal->get_modal_trigger($button_text, 'button button--primary'); ?>
				<?= $modal->get_modal_html('full-page-modal'); ?>
			</footer>

		</section>
		<?php
	endif;
endif;
