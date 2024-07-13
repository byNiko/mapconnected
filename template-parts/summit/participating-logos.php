<?php

if (have_rows('attending_companies_group')) :
	while (have_rows('attending_companies_group')) : the_row('attending_companies_group');
		if ($logos = get_sub_field('attending_company_logos')) :
			$logo_limit = get_sub_field('limit');
			$logo_html_array = [];
			$pattern = '<div class="logo-item"> %s </div>';
			$title = get_sub_field('title');
			foreach ($logos as $logo) :
				$logo_html_array[] = wp_sprintf(
					$pattern,
					wp_get_attachment_image($logo, 'medium', false, ['loading' => 'lazy'])
				);
			endforeach;
?>
			<section id="participating-logos" class="theme--medium-1 py-1">
				<div class="container--narrow">
					<header class="text-center">
						<h2 class="h2"><?= $title; ?> </h2>
					</header>
					<div class="logo-gallery">
						<?php
						$count = 0;
						foreach ($logo_html_array as $logo) :
							$count++;
							if ($logo_limit < $count) break;
							echo $logo;
						endforeach;
						?>
					</div>
					<?php 
					if ($text = get_sub_field('view_all_logos_button_text')) :
							$pattern = '<div class="logo-gallery"> %s </div>';
							$all_logos = array_reduce($logo_html_array, function($carry, $item){
								$carry .= $item; 
								return $carry;
							}, $carry = '');
						$logos_wrapper = wp_sprintf(
							$pattern,
							$all_logos
						);

						$modal = new Modal('participating-logos-modal', $title, $logos_wrapper);

					?>
						<footer class="text-center mt-1">
							<!-- <button class="button button--primary" data-toggle="micromodal"> -->
								<? //= $text; ?>
								<?= $modal->get_modal_trigger($text, 'button button--primary');?>
							<!-- </button> -->
							 <?= $modal->get_modal_html('full-page-modal');?>
						</footer>

					<?php endif; ?>
				</div>
			</section>

<?php
		endif;
	endwhile;
endif;
