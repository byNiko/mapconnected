<?php
$event = new Event($post);
$times = $event->get_time();
$expired_class = $event->is_past() ? "disabled" : null;


function byniko_is_dateobject($datetimeObject) {
	return ($datetimeObject instanceof DateTime);
}
function format_datetime($datetimeObject, $time = true) {
	$time = $time ? 'n/d/Y g:i a' : 'm/d/Y';
	return $datetimeObject->format($time);
}
function byniko_get_event_time_list_item($value, $label, $time = true) {
	if ($value) {
		$value = byniko_is_dateobject($value) ? format_datetime($value, $time) : $value;

		// if (byniko_is_dateobject($dateObject)) :
		$html =
			"<dl class='event__time '>" .
			"<dt class='event__time-label'><b>$label:</b></dt>" .
			"<dd class='event__time-value'>" . $value . "</dd>" .
			"</dl>";
		return $html;
	}
	// endif;
}
?>
<aside id="event-sidebar" class="sidebar single-event-sidebar">
	<?= get_acf_link($event->get_reservation_link(), "$expired_class d-flex justify--center  text-uppercase  has-shadow-1 button button--accent"); 	?>
	<div class="event__time-list  event-sidebar sidebar--default-theme">
		<?= $event->is_virtual_event
			? byniko_get_event_time_list_item("Virtual", "Location")
			: byniko_get_event_time_list_item($event->location, "Location");
		?>
		<?= byniko_get_event_time_list_item($times['start'], "Start"); ?>
		<?= byniko_get_event_time_list_item($times['end'], "End"); ?>
		<?= byniko_get_event_time_list_item($times['registration_open'], "Registration Opens", false); ?>
		<?= byniko_get_event_time_list_item($times['registration_ends'], "Registration Ends", false); ?>
		<?= byniko_get_event_time_list_item($times['early_registration_cutoff'], "Early Registration Cutoff", false); ?>
		<?= byniko_get_event_time_list_item($times['late_registration_begins'], "Late Registration Begins", false); ?>
		<?php
		if (have_rows('datetime_repeater')) : while (have_rows('datetime_repeater')) : the_row();
				if ($dateTime = get_sub_field('custom_date_time'))
					echo byniko_get_event_time_list_item(new DateTime($dateTime), get_sub_field('label'), true);
			endwhile;
		endif;
		?>
	</div>
	<div class="event__buttons-list no-bullets flex-column  event-sidebar mt-1">
		<?php
		if (have_rows('sidebar_buttons')) :  while (have_rows('sidebar_buttons')) : the_row();
				$layout = get_row_layout();
				if ($layout == 'link') {
					$button = get_sub_field('button');
					echo get_acf_link($button, 'button button--tertiary button--outline');
				}
				if ($layout == 'download') {
					$file_url = get_sub_field('download_file');
					$label = get_sub_field('download_label') ?: "Download";
					if ($file_url && $label)
						echo "<a href='$file_url' class='button button--tertiary button--outline' download>$label <span class='dashicons dashicons-download'></span></a>";
				}
			endwhile;
		endif;
		// if ($buttons) :
		// 	foreach ($buttons as $button) :
		// 		get_acf_link($button['button'], 'button button--tertiary button--outline');
		// 	endforeach;
		// endif;
		?>
	</div>
	<?php dynamic_sidebar('sidebar-events'); ?>
</aside><!-- #secondary -->