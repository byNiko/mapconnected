<?php

$summit_post = $args['summit_post'];
if(have_rows('agenda_group', $summit_post)): while(have_rows('agenda_group', $summit_post)): the_row();


?>
	<div class="grid __3x">
		<?php if(have_rows('daily_agendas')):while(have_rows('daily_agendas')): the_row();?>
			<div class="agenda__item-wrap">
				<div class="agenda__title"><?php the_sub_field('title'); ?></div>
				<div class="agenda__dates"><?php the_sub_field('dates'); ?></div>
				<div class="agenda__contents"><?php the_sub_field('content'); ?></div>
			</div>
		<?php  endwhile; endif; ?>
	</div>

<?php
endwhile; endif;
