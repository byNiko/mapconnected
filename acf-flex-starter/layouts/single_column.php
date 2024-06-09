<div class="container--single-column">
	<?php
	get_template_part('/acf-flex-starter/layouts/headings');
	$content = get_sub_field('content');

	if ($content) : ?>
		<div class="content">
			<?= $content; ?>
		</div>
		<?php get_template_part('/acf-flex-starter/layouts/button_row'); ?>
</div>
<?php
	endif;
