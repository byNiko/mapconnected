<?php

$s = new Summit($post);
$s->get_landing_section_data();
function makeCounterEl($data) {
	$pattern = '
	<div class="bold-stat">
		<div class="bold-stat__number">%1$s<sup>%3$s</sup></div>
		<div class="bold-stat__title">%2$s</div>
	</div>
	';

	return wp_sprintf($pattern, $data['value'], $data['title'], $data['sup']);
}
function getStatCounters() {
	if (have_rows('statistics_group')) :
		while (have_rows('statistics_group')) :
			the_row();
			if (have_rows('counters')) :
				while (have_rows('counters')) :
					the_row();
					$data = [
						'value' => get_sub_field('value'),
						'title' => get_sub_field('title'),
						'sup' => get_sub_field('superscript')
					];
					echo makeCounterEl($data);
				endwhile;
			endif;
		endwhile;
	endif;
}


if (have_rows('landing_section')) :
	while (have_rows('landing_section')) :
		the_row();
?>
<div class="container--narrow landing__container">
	<div class="summit-logo text-center">
		<?= $s->get_summit_logo();?>
	</div>
	<div class="landing__text">
		<?= $s->landing_text ;?>
	</div>
	<!-- new glass section -->
	<div class="glass">
		<div class="stats-list">
			<?php getStatCounters(); ?>
		</div>
	</div>

<?=  $s->getRegistrationLinksSection();?>
</div>
<?php
	endwhile;
endif;