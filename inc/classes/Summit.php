<?php

class Summit {
	private $post;
	public $summit_logo_id,
		$landing_text,
		$theme_title,
		$theme_subtitle,
		$theme_summit_text;

	public function __construct($post) {
		$this->post = $post;
		$this->summit_logo_id = $this->get_landing_section_data('summit_logo');
		$this->landing_text = $this->get_landing_section_data('landing_text');
		$this->theme_title = $this->get_landing_section_data('summit_theme_title');
		$this->theme_subtitle = $this->get_landing_section_data('summit_theme_subtitle');
		$this->theme_summit_text = $this->get_landing_section_data('summit_theme_text');
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
}
