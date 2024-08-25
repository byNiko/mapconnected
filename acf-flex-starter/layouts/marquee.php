<?php
$img_id = get_sub_field('image');
$text = get_sub_field('text');
?>

<div class="flexible-content-wrap">
	<div class="container--wide">
		<div class="d-flex flex-column align--center">
			<?php
			if ($img_id)
				echo wp_get_attachment_image($img_id, 'img-fluid');
			?>
			<?php get_template_part('/acf-flex-starter/layouts/paragraph'); ?>
			<?php get_template_part('/acf-flex-starter/layouts/button_row'); ?>
		</div>
	</div>
</div>