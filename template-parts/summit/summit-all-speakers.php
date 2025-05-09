<?php

$s = new Summit($post);
$active_speakers_data = $s->get_active_speakers_data();
$hide_modal = $s->speakers_group['hide_all_speakers_popup_button'];
if (!$hide_modal):
	$modal_all_speakers = $s->get_all_speakers_modal();
	$modal_cta_text = $s->speakers_group['all_speakers_popup_button_text'] ?? "View All Speakers";
endif;


if (
	isset($active_speakers_data['active_speakers'])
	&& isset($active_speakers_data['key_speakers'])
) :
	$active_speakers = $active_speakers_data['active_speakers'];
	$key_speakers = $active_speakers_data['key_speakers'];
	$title = $active_speakers_data['title'];
?>

	<div class="container--narrow">
		<?php
		if ($title) : ?>
			<header class="text-center">
				<h3 class="h3 text-center"><?= $title; ?></h3>
				<?php
				if (!$hide_modal)
					echo $modal_all_speakers->get_modal_trigger($modal_cta_text, "button button--accent");
				?>
			</header>
		<?php
		endif; ?>
	</div>

	<div class="container mt-1">
		<div class="grid __5x justify--center">
			<?php
			if (is_array($active_speakers)) :
			foreach ($active_speakers as $speaker) :
				$sp = new Speaker($speaker);
				$hide_speaker_info = !(new Byniko())->hide_speaker_info_after_delay($s);
					$args = array(
						'include_anchor' => $hide_speaker_info,
						'show_name' => $hide_speaker_info
					);
				echo $sp->get_the_speaker_card($args);
			endforeach;
		endif;
			?>
		</div>
	</div>
<?php
	if (!$hide_modal)
		echo $modal_all_speakers->get_modal_html(' full-page-modal');

endif;
