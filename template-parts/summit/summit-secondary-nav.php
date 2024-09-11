<nav class="secondary-nav">
	<?php
	if ($nav_repeater = get_field('secondary_navigation')):
		foreach ($nav_repeater as $nav_item => $data):
			if ($data['is_active']):
	?>
				<a href="#<?= $data['button_anchor']; ?>"
					class="button button--text"><?= $data['button_text']; ?>
				</a>
	<?php
			endif;
		endforeach;
	endif;
	?>
</nav>