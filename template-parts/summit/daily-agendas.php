<?php

$summit_post = $args['summit_post'];
$agendas = get_field('daily_agendas', $summit_post);

if (have_rows('daily_agendas', $summit_post)) :
?>
	<div class="grid __3x">
		<?php while (have_rows('daily_agendas', $summit_post)) : the_row('daily_agendas', $summit_post); ?>
			<div class="agenda__item-wrap">
				<div class="agenda__title"><?php the_sub_field('title'); ?></div>
				<div class="agenda__dates"><?php the_sub_field('dates'); ?></div>
				<div class="agenda__contents"><?php the_sub_field('content'); ?></div>
			</div>
		<?php endwhile; ?>
	</div>

<?php
endif;
