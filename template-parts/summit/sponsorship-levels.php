
<?php
$count = 0;

	// if (have_rows('sponsorship_group')) :
	// 	while (have_rows('sponsorship_group')) :
	// 		the_row();

if (have_rows('sponsorships')) :
?>
	<?php
	while (have_rows('sponsorships')) :
		the_row('sponsorships');
		$count++;
		$sponsors = get_sub_field('sponsors');
		if ($sponsors) :
	?>
			<div class="sponsor-level sponsor-level--<?= $count; ?>">
				<div class="sponsor-level__title">
					<?php the_sub_field('sponsor_level'); ?>
				</div>

				<div class="grid ">
					<?php

					foreach ($sponsors as $sponsor) :
						$s = new Sponsor($sponsor);
						echo $s->get_sponsor_logo_with_link();
					endforeach;

					?>
				</div>
			</div>

<?php
		endif;
	endwhile;
endif;
// endwhile;
// endif;