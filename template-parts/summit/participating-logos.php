<?php

if (have_rows('attending_companies_group')) :
	while (have_rows('attending_companies_group')) : the_row('attending_companies_group');
		if ($logos = get_sub_field('attending_company_logos')) :		
?>
			<section id="participating-logos" class="theme--medium-1 py-1">
				<div class="container--narrow">
					<header class="text-center">
						<h2 class="h2"><?= get_sub_field('title'); ?> </h2>
					</header>
					<div class="logo-gallery">
						<?php
						$count = 0;
						foreach ($logos as $logo) :
							$count++;
							$limit = get_sub_field('limit');
							if ($limit < $count) break;
						?>
							<div class="logo-item"><?= wp_get_attachment_image($logo, 'medium', false, ['loading' => 'lazy']); ?></div>
						<?php
						endforeach;
						?>
					</div>
					<footer class="text-center mt-1">
							<?=  get_acf_link(get_sub_field('page_link'), 'button button--primary'); ?>
					</footer>
				</div>
			</section>

<?php
		endif;
	endwhile;
endif;
