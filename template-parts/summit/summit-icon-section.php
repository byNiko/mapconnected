<section id="icon-section" class="theme--dark-1 icon-section ">
	<div class="container--very-narrow">
		<header class="text-center">
			<h2 class="h2"><?= get_sub_field('title'); ?></h2>
			<div class="subtitle"><?= get_sub_field('subtitle');?></div>
		</header>
		<div class="content text-center mt-1"><?= get_sub_field('short_copy');?></div>
	</div>
	<div class="container--narrow">
		<?php get_template_part('/acf-flex-starter/layouts/icon_grid'); ?>
	</div>
</section>