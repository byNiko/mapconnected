<?php

class Event {
	public $post;
	private $reservationLink;
	private $permalink;
	private $description;
	private $time;
	private $sponsors;
	private $speakers;
	public $is_virtual_event;
	public $is_this_year;
	public $location;
	public $is_past;
	public $tags;
	public $is_multi_day;
	public $toggle_speaker_names;
	public $toggle_speaker_delay_in_days;
	public $toggle_speaker_date_is_past;
	public $hide_speaker_info;

	public function __construct($post) {
		$this->post                                 = $post;
		$this->reservationLink                      = get_field('reservation_link', $post);
		$this->permalink                            = get_permalink($post);
		$this->description                          = get_field('description', $post);
		$this->time['start_date']                   = get_field('start_date__time', $post);
		$this->time['start']                        = get_field('start_date__time', $post) ? new DateTime($this->time['start_date']) : false;
		$this->time['end']                          = get_field('end_date__time', $post) ? new DateTime(get_field('end_date__time', $post)) : false;
		$this->time['registration_open']            = get_field('registration_opens', $post) ? new DateTime(get_field('registration_opens', $post)) : false;
		$this->time['registration_ends']            = get_field('registration_ends', $post) ? new DateTime(get_field('registration_ends', $post)) : false;
		$this->time['early_registration_cutoff']    = get_field('early_registration_cutoff', $post) ? new DateTime(get_field('early_registration_cutoff', $post)) : false;
		$this->time['regular_registration_cutoff']  = get_field('regular_registration_cutoff', $post) ? new DateTime(get_field('regular_registration_cutoff', $post)) : false;
		$this->time['late_registration_begins']     = get_field('late_registration_begins', $post) ? new DateTime(get_field('late_registration_begins', $post)) : false;
		$this->sponsors                             = get_field('sponsors', $post);
		$this->speakers                             = get_field('speakers', $post);
		$this->is_virtual_event						= get_field('is_a_virtual_event', $post);
		$this->location								= get_field('location', $post);
		$this->is_past								= $this->is_past();
		$this->tags									= wp_get_post_terms($post->ID, 'event-type');
		$this->is_this_year							= $this->time['start'] && $this->time['start']->format('Y') === date("Y");
		$this->is_multi_day							= ($this->time['start'] && $this->time['end']) ? $this->time['start']->format('d') !==  $this->time['end']->format('d') : false;
		// $this->toggle_speaker_names					= get_field('toggle_speaker_names', $post);	
		// $this->toggle_speaker_delay_in_days			= get_field('toggle_speaker_delay_in_days', $post); // days after event start to show speakers
		// $this->toggle_speaker_date_is_past			= $this->toggle_speaker__date_is_past();// date to show speakers
		$this->hide_speaker_info					= $this->toggle_speaker_date_is_past && $this->toggle_speaker_names;
	}

	public function get_end_date() {
		return $this->time['end'] ?:  $this->time['start'];
	}
	public function event_has_ended() {
		return Byniko::date_is_past($this->get_end_date());
	}

	public function hide_speaker_info() {
		return (new Byniko())->hide_speaker_info_after_delay($this);
	}

	public function is_multi_day() {
		if ($this->time['start'] && $this->time['end'])
			return $this->time['start']->format('d') !==  $this->time['end']->format('d');
		return false;
	}
	public function get_title() {
		return $this->post->post_title;
	}
	public function get_reservation_link() {
		return $this->reservationLink;
	}
	public function get_permalink() {
		return $this->permalink;
	}
	public function remove_forced_spaces($content) {
		if ($content) {
			$string = htmlentities($content);
			$content = str_replace("&nbsp;", " ", $string);
			$content = html_entity_decode($content);
		}
		return $content;
	}
	public function get_description() {
		return $this->remove_forced_spaces($this->description);
	}
	public function get_time($type = null) {
		return $this->time;
	}
	public function get_sponsors() {
		return $this->sponsors;
	}
	public function get_speakers() {
		return $this->speakers;
	}


	public function is_past() {
		$start = get_field('start_date__time', $this->post);
		// $b = new Byniko();
		$future = Byniko::future_expiration();
		// return true;
		return strtotime("$future") > strtotime("$start");
	}
	public function get_event_tag_pills() {
		$tags = $this->tags;
		$html = '';
		if ($tags) :
			foreach ($tags as $tag):
				$html .= sprintf(
					'<span 
				class="pill taxonomy-pill"
				data-taxonomy="event-type" data-taxonomy-slug="%2$s">%1$s
				</span>',
					$tag->name,
					$tag->slug
				);
			endforeach;
			return $html;
		endif;
		return false;
	}
}
