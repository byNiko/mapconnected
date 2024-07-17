

<div class="container--narrow">
	<div class="flex-row __2x inner-container theme--medium-2">
		<div class="col">
			<?php echo wp_get_attachment_image($args['section_image'], 'full'); ?>
			<p class="mt-1 fw-bold">
			<?= $args['image_caption']; ?>
			</p>
		</div>
		<div class="col">
			<header>
				<h3 class="h3"><?= $args['title'];?></h3>
				<div class="content"><?= $args['text'];?></div>
			</header>
		</div>
	</div>
</div>