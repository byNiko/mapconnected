<?php

$event = new Event($post);
$times = $event->get_time();
$start_datetime = $times['start'];
$end_datetime = $times['end'];
$startMonth = $start_datetime ? $start_datetime->format('M') : null;
$startDay = $start_datetime ? $start_datetime->format('D') : null;
$startDate = $start_datetime ? $start_datetime->format('jS') : null;
?>
<div class="event-archive-item event d-flex">
	<div class="event-archive-item--meta-date text-center">
		<div class="fz-sm"><?= $startMonth; ?></div>
		<div class="fz-md fw-semi-bold"><?= $startDate; ?></div>
	</div>
	<div class="event-item--info">
		<header class="event--header ">
			<div class="event--start-time fz-xs">

				<?php
				$format = $event->is_this_year ?  'F d @ g:iA': 'F d, Y @ g:iA';
				$end_format = $event->is_multi_day()? ' - F d @ g:iA': ' - g:iA';
				echo !empty($start_datetime) ? $start_datetime->format($format) : "";
				echo !empty($end_datetime) ? $end_datetime->format($end_format) : '';
				echo !empty($start_datetime)? " ET": ''; // timezone hardcoded. WP and ACF have complicated Timezone issues.
				?>
			</div>
		</header>
		<h3 class="h3 event--title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="event--description">
			<?
			if($desc = $event->get_description()){
				echo wp_trim_words($desc, 15); 
			} else the_excerpt();
				?> 
		</div>
		<div class="event--footer">
		<div class="event--categories pillbox">
				<?= $event->get_event_tag_pills(); ?>
			</div>
		</div>
	</div>
	<aside class="event-archive-item--sidebar">
		<div class="event-archive-item--buttons d-flex flex-column align--center">
			<?
			$disabled = $event->is_past() ? "disabled" : '';
			echo get_acf_link($event->get_reservation_link(), "$disabled has-shadow-1 event-archive-item--button button button--primary");
			?>
			<a class="has-shadow-1 button button--secondary button--outline event-archive-item--button" href="<?php the_permalink(); ?>"> More Info </a>
		</div>
	</aside>
</div>