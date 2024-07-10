<div class="flexible-content-wrap">
	<?php
	get_template_part('/acf-flex-starter/layouts/headings');
	$content = get_sub_field('content');
	$text_size = get_sub_field('text_font_size') ?? 'md';

	if ($content) : ?>
		<div class="container--single-column">
			<div class="content fz-<?= $text_size; ?>">
				<?= $content; ?>
			</div>
		<?php endif; ?>
		</div>
		<footer>
			<?php get_template_part('/acf-flex-starter/layouts/button_row'); ?>
		</footer>
</div>