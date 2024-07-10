<?php
if (have_rows('card_grid')) :
?>
	<div class="flexible-content-wrap">
		<div class="card-grid container--narrow">
			<div class="flex-row">
				<?php
				// Loop through rows.
				while (have_rows('card_grid')) : the_row();

					// Load sub field value.
					$image_url = wp_get_attachment_image_srcset(get_sub_field('image'), 'medium');
					$title = get_sub_field('title');
					$content = get_sub_field('content');
					$theme_style = get_sub_field('theme');
				?>
					<div class="image-card flex-column theme--<?= $theme_style; ?>">
						<div class="card__title text-center h3 fw-semi-bold"><?= $title; ?></div>
						<div class="card__image-wrap"><img srcset="<?= $image_url; ?> " alt=""></div>
						<div class="card__content"><?= $content; ?></div>
					</div>
				<?php
				endwhile; ?>
			</div>
		</div>
	</div>
<?php
endif;
