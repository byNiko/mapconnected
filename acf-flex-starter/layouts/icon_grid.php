<?php
$icon_position = get_sub_field('icon_position') === "left" ? "icon-left" : "icon-top";

if ($theme_group = 	get_sub_field('theme_group')) :
	$container_width = 'container--' . $theme_group['container_width'];
	$theme = 'theme--' . $theme_group['theme'];
endif;
if (have_rows('icon_grid')) :
?>
	<div class="flexible-content-wrap">
		<div class="<?= $container_width; ?>">
			<!-- <div class="icon-grid__wrapper"> -->
				<div class="inner-container <?= $theme; ?>">
					<div class="icon-grid">
						<?php
						// Loop through rows.	
						while (have_rows('icon_grid')) : the_row();
							// Load sub field value.
							$icon = get_sub_field('icon');
							$title = get_sub_field('title');
							$content = get_sub_field('content');
						?>
							<div class="icon-card <?= $icon_position; ?>">
								<div class="card__icon"><?= $icon; ?></div>
								<div class="flex-column">
									<div class="card__title"><?= $title; ?></div>
									<div class="card__content"><?= $content; ?></div>
								</div>
							</div>
						<?php
						endwhile; ?>
					</div>
				</div>
			<!-- </div> -->
		</div>
	</div>
<?php
endif;
