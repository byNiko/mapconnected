<?php

if ($travel = get_field('travel_group', $args['summit_post'])) :

?>
	<section id="travel" class="travel_troup theme--dark-1 py-1">
		<div class="container--narrow">
			<header class="text-center">
				<h2 class="h2">Hotel Info</h2>
				<h3 class="h3"><?= $travel['travel_headline']; ?></h3>
			</header>
			<div class="flex-row flex-container">
				<div class="col">
					<div class="content">
						<?= $travel['travel_text'] ?: null; ?>
					</div>
					<?php
					if ($travel['travel_link']) :
					?>
						<div class="travel_link">
							<a href="<?= $travel['travel_link']['url']; ?>" class="button button--accent" target="<?= $travel['travel_link']['target']; ?>">
								<?= $travel['travel_link']['title']; ?>
							</a>
						</div>
					<?php
					endif;
					?>
				</div>
				<?php
				if ($img = wp_get_attachment_image($travel['travel_image'], 'full')) :
				?>
					<div class="col">
						<?= $img; ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</section>
<?php
endif;
