<?php

class Summit {
	public $post,
	$summit_logo_id,
		$landing_text,
		$theme_title,
		$theme_subtitle,
		$theme_summit_text,
		$speakers_group,
		$active_speakers_data;

	public function __construct($post) {
		$this->post = $post;
		$this->summit_logo_id = $this->get_landing_section_data('summit_logo');
		$this->landing_text = $this->get_landing_section_data('landing_text');
		$this->theme_title = $this->get_landing_section_data('summit_theme_title');
		$this->theme_subtitle = $this->get_landing_section_data('summit_theme_subtitle');
		$this->theme_summit_text = $this->get_landing_section_data('summit_theme_text');
		$this->speakers_group = get_field('speakers_group');
		$this->active_speakers_data = $this->get_active_speakers_data();
	}

	public function get_landing_section_data($key = false) {

		$landing = get_field('landing_section', $this->post);

		return $key ? $landing[$key] : $landing;
	}

	public function get_agenda_section_data($key = false) {
		$agenda = get_field('agenda_group', $this->post);

		return $key ?  $agenda[$key] : $agenda;
	}
	public function get_statistics_section_data($key = false) {
		$statistics = get_field('statistics_group', $this->post);

		return $key ?  $statistics[$key] : $statistics;
	}

	public function get_summit_dates_section_data($key = false) {
		$dates = get_field('dates', $this->post);

		return $key ?  $dates[$key] : $dates;
	}

	public function has_summit_logo() {
		return wp_validate_boolean($this->summit_logo_id);
	}

	public function get_summit_logo() {
		return wp_get_attachment_image($this->summit_logo_id, 'full');
	}


	/**
	 * get summit registration links
	 * 
	 * @return array
	 */
	public function getRegistrationLinks() {
		$links = [];
		if ($registration_section = get_field('landing_section')['registration_links']) {
			foreach ($registration_section as $link) :
				if (is_array($link)) {
					$title = $link['title'];
					$url = ($link['url']);
					$modal = new ModalIframe($url, $title);
					if ($modal) :
						$links[] = $modal->get_trigger($title, 'button button--accent button--register');
					endif;
				}
			endforeach;
		}
		return $links;
	}

	/**
	 * Undocumented function
	 *
	 * @return string html string
	 */
	public function getRegistrationLinksSection() {
		if ($registration_section = $this->get_landing_section_data('registration_links')) {

			$title = $registration_section['title'] ?? "";

			$links = $this->getRegistrationLinks();

			$l = array_reduce($links, function ($acc, $itt) {
				$acc .= $itt;
				return $acc;
			});
			$pattern = '
		<div class="registration__ctas">
			<heading>
				<h2 class="registration-links--title text-center">%1$s</h2>
			</heading>
			<div class="flex-row __2x align-center">
					%2$s
			</div>
		</div>
		';
			return wp_sprintf($pattern, $title, $l);
		}
	}

	/**
	 * Undocumented function
	 *
	 * @return string
	 */
	public function get_promotional_video() {
		$video_url = $this->get_landing_section_data('promotional_video_url');
		$attr = array(
			// 'src'        =>  wp_get_attachment_url(480),
			'src'        => $video_url,
			'height'     => 360,
			'width'      => 640,
			'poster'     => '',
			'loop'       => '',
			'autoplay'   => '',
			'muted'      => 'false',
			'preload'    => 'metadata',
			'class'      => 'wp-video-shortcode',
		);

		return wp_video_shortcode($attr);
	}

	public function get_end_date(){
		return $this->get_summit_dates_section_data('summit_end_date');
		// return new DateTime("October 2, 2024");
	}

	public function getAgendaHighlights() {
		$html = false;
		if ($highlights = $this->get_agenda_section_data('agenda_highlights')) :

			$html = "<dl class='columns__1'>";
			$html .= array_reduce($highlights, function ($acc, $itt) {
				if (!$itt['title']) return $acc;

				$pattern = '<div class="column__no-break"><dt>%1$s</dt><dd>%2$s</dd></div>';
				$acc .= wp_sprintf($pattern, $itt['title'], $itt['description']);
				return $acc;
			});
			$html .= "</dl>";
		endif;
		return $html;
	}

	public function longCopySections() {
	}

	public function getLongCopySectionData($index = 0) {
		$sections = get_field('long_copy_sections', $this->post);
		return $sections[$index];
	}

	function isAgendaDownloadAvailable() {
		return $this->get_agenda_section_data('direct_agenda_download_available');
	}
	function getAgendaDownloadLink() {
		$link = false;
		if ($this->get_agenda_section_data('direct_agenda_download_available')) {
			$link = $this->get_agenda_section_data('download_agenda_button');
		}
		return $link;
	}

	function getAgendaScrollLink() {
		$agenda_download_link = $this->getAgendaDownloadLink();
		return $agenda_download_link ? '#agenda' : '#brochure-download';
	}

	public function get_active_speakers_data($speakers_group = null) {
		$speakers_group = $speakers_group ?: $this->speakers_group;
		$arr = [];
		if ($speakers_repeater = $speakers_group['speakers_repeater']) :
			foreach ($speakers_repeater as $group) :
				$hide = $group['hide_group'];
				if (!$hide):
					$arr['active_speakers'] = $group['all_speakers'];
					$arr['key_speakers'] = $speakers_group['key_speakers'];
					$arr['title'] = $group['summit_speakers_title'];
				endif;
			endforeach;
		endif;
		return $arr;
	}

	public function get_modal_speaker_html($speaker) {
		$events_list = '';
		$hide_speaker_info = !(new Byniko())->hide_speaker_info_after_delay($this);
		$speaker_card_args = array(
			'include_anchor' => $hide_speaker_info,
			'show_name' => $hide_speaker_info
		);

		if ($speaker->get_future_events()):
			$events_list .= '<div class="speaker__events-list">
				<h4 class="h4">Upcoming Events</h4>' .
				$speaker->get_events_list() . '
			</div>';
		endif;

		$session_info = '';
		if ($info = $speaker->get_session_info()):
			$session_info.= '<div class="speaker__session-info">
						<h2 class="speaker__session-title h2">
							' . $info['sess_title'] . '
						</h2>
						<div class="speaker__session-desc">
							' . $info['sess_desc'] . '
						</div>
					</div>';
		endif;

		$speaker_bio = '';
		if ($bio = $speaker->get_bio()):
			$speaker_bio = '<div class="speaker__bio">
				<h3 class="h3">Bio</h3>
			' . $bio . '
			</div>';
		endif;

		$pattern = '
		<div class="entry-content modal-speaker-content grid has-sidebar mt-4">
			<aside class="sidebar">
				%1$s
			</aside>
			<div class="speaker__info main">
				<header class="entry-header">
					<h2> %5$s</h2>
				</header>
				<div class="content-column">
			
 				%2$s
				%3$s
				%4$s

				</div>
				</div>
				</div>
				<hr>
			';


		return sprintf(
			$pattern,
			$speaker->get_the_speaker_card($speaker_card_args),
			$events_list,
			$session_info,
			$speaker_bio,
			$hide_speaker_info? $speaker->get_name(): null, 
		);
?>

<?php
	}
	public function get_all_speakers_modal() {

		$data = $this->active_speakers_data;
		$all_speakers = is_array($data['active_speakers']) ? $data['active_speakers'] : [];
		$key_speakers = is_array($data['key_speakers']) ? $data['key_speakers'] : [];
		// $key_speakers = $data['key_speakers'];
		
		// Merge key speakers with all speakers
		$merged_speakers = array_merge($key_speakers, $all_speakers);
		// Remove Duplicates & set company name
		$all_reduced = array_reduce($merged_speakers, function ($acc, $item) {
			if (!isset($acc[$item->ID])) {
				$s = new Speaker($item);
				$item->company = $s->get_company(); 
				// $bN = new Byniko();
				// $name = $bN->split_name($item->post_title);
				// $item->first_name = $name[0];
				// $item->last_name = $name[1];
				$acc[$item->ID] = $item;
			}
			return $acc;
		}, []);

		// Sort by last name
		usort($all_reduced, function ($a, $b) {
			return strcmp($a->company, $b->company);
		});
		$speakersHtml = "";
		foreach ($all_reduced as $speaker) :
			$sp = new Speaker($speaker);
			// $speakersHtml .= $sp->get_the_speaker_card(true);
			$speakersHtml .= $this->get_modal_speaker_html($sp);
		endforeach;

		$html = "
	<div class='modal-speakers-container'>
	$speakersHtml
	</div>";

		$modal = new Modal(
			'all-speakers',
			$this->speakers_group['all_speakers_popup_title_text'],
			$html
		);
		return $modal;
	}
}
