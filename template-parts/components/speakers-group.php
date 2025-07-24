<div class="grid __5x speakers-list">
	<?php

	$speakers = get_field('speakers_group');
	if ($speakers) :
		foreach ($speakers as $sp) :
			$s = new Speaker($sp);
			$args = array(
				'show_name' => false,
				'include_anchor' => false
			);
			$s->the_speaker_card($args);

		endforeach;
	endif;
	?>
</div>