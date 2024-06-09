<?php
$icon_position = get_sub_field('icon_position') === "left"? "flex-row" : "flex-column";

if ($theme_group = 	get_sub_field('theme_group')) :
	$container_width = 'container--' . $theme_group['container_width'];
	$theme = 'theme--' . $theme_group['theme'];
endif;
if (have_rows('icon_grid')) :
?>
	<section class="icon-grid__wrapper">
		<div class="<?= $container_width . '  ' . $theme;?>">
			<div class="icon-grid grid __3x justify--center">
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
	</section>
<?php
endif;
