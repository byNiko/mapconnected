<?php
load_class('Event');
$event = new Event($post);
$times = $event->get_time();

function byniko_is_dateobject($datetimeObject) {
	return ($datetimeObject instanceof DateTime);
}
function format_datetime($datetimeObject, $time = true) {
	$time = $time? 'n/d/Y g:i a' : 'm/d/Y';
	return $datetimeObject->format($time);
}
function byniko_get_event_time_list_item($dateObject, $label, $time = true) {
	if (byniko_is_dateobject($dateObject)) :
		$html =
			"<dl class='event__time '>" .
			"<dt class='event__time-label'><b>$label:</b></dt>" .
			"<dd class='event__time-value'>" . format_datetime($dateObject, $time) . "</dd>" .
			"</dl>";
		return $html;
	endif;
}
?>
<aside id="event-sidebar" class="sidebar">
<?= get_acf_link($event->get_reservation_link(), "d-flex justify--center  text-uppercase  has-shadow-1 button button--accent"); 	?>
	<div class="event__time-list  event-sidebar sidebar--default-theme">
		<?= byniko_get_event_time_list_item($times['start'], "Start"); ?>
		<?= byniko_get_event_time_list_item($times['end'], "End"); ?>
		<?= byniko_get_event_time_list_item($times['registration_open'], "Registration Opens", false); ?>
		<?= byniko_get_event_time_list_item($times['registration_ends'], "Registration Ends", false); ?>
		<?= byniko_get_event_time_list_item($times['early_registration_cutoff'], "Early Registration Cutoff", false); ?>
		<?= byniko_get_event_time_list_item($times['late_registration_begins'], "Late Registration Begins", false); ?>
	</div>
	<div class="event__buttons-list no-bullets flex-column  event-sidebar mt-1">	
		<?php
		$buttons = get_field('sidebar_buttons');
		foreach ($buttons as $button) {
			// print_r($button);
		?>
			<?= get_acf_link($button['button'], 'button button--tertiary button--outline'); ?>
		<?php
		}	
		?>
	</div>
</aside><!-- #secondary -->