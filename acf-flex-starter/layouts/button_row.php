<?php
$is_child = $args ? $args['is_child'] : false;
$buttons = get_sub_field('button_repeater');
if (!empty($buttons)) : ?>
	<div class="">
		<div class="button-row--wrapper container--very-narrow">
			<div class="button_row flex-row justify--center">
				<?php
				foreach ($buttons as $button) : ?>
					<div class="button-row--col d-flex">
						<?php get_acf_button($button); ?>
					</div>
				<?php endforeach;	?>
			</div>
		</div>
	</div>
<?php endif;
