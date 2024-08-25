<?php
class Speaker {
	private $ID;
	private $name;
	private $title;
	private $company;
	private $company_logo_object;
	private $bio;
	private $headshot1_object;
	private $headshot2_object;
	private $associated_events;

	public function __construct($speaker = null) {
		if (!$speaker) return;
		$this->ID = $speaker->ID;
		$this->name = $speaker->post_title;
		$this->title = get_field('title', $speaker);
		$this->company = get_field('company', $speaker);
		$this->company_logo_object = get_field('logo', $speaker);
		$this->bio = get_field('bio', $speaker);
		$this->headshot1_object = get_field('primary_headshot', $speaker);
		$this->headshot2_object = get_field('secondary_headshot', $speaker);
		$this->associated_events = get_field('events', $speaker);
	}

	public function get_ID() {
		return $this->ID;
	}
	public function get_name() {
		$hide = get_field('hide_names_group_hide_speaker_names', 'option');
		return $hide ? false : $this->name;
	}
	public function get_bio() {
		return $this->bio;
	}

	public function get_title() {
		return $this->title;
	}
	public function get_company() {
		return $this->company;
	}
	public function get_logo_object() {
		return $this->company_logo_object;
	}
	public function get_logo() {

		return $this->company_logo_object
			? wp_get_attachment_image($this->company_logo_object['ID'], 'medium')
			: null;
	}
	public function get_headshot1_object() {
		return $this->headshot1_object;
	}
	public function get_headshot1() {
		if ($ID = $this->get_headshot1_object()['ID'])
			return wp_get_attachment_image($ID, 'portrait');
	}
	public function get_the_headshot1() {
		echo $this->get_headshot1();
	}

	public function get_active_headshot(){
		/**
		 * this realies on the featured image being updated correctly 
		 * useing filters in functions acf_set_featured_image
		**/
		$id = get_post_thumbnail_id($this->ID);
		return wp_get_attachment_image($id, 'portrait');
	}
	public function get_headshot2_object() {
		return $this->headshot2_object;
	}
	public function get_headshot2() {
		return wp_get_attachment_image($this->get_headshot2_object()['ID'], 'full');
	}

	public function get_headshot2_url($size = 'large') {
		return wp_get_attachment_image_src($this->get_headshot2_object()['ID'], $size)[0];
	}
	public function get_secondary_image_data() {
		return wp_get_attachment_metadata($this->get_headshot2_object()['ID']);
	}
	public function get_associated_events() {
		return $this->associated_events;
	

		// $default_args = array(
		// 	'posts_per_page' => -1,
		// 	'post_type' => 'speaker',
		// 	'post_status' => 'publish',	
		// 	'orderby'        => 'rand',
		// 	'post__not_in' => [],
		// 	// 'tax_query' => array(
		// 	// 	array(
		// 	// 		'taxonomy' => 'testimonial-type',
		// 	// 		'field' => 'name',
		// 	// 		'terms' => 'Brand Member',
		// 	// 	)
		// 	// ),
		// );
		// $args = array_merge($default_args, $args);
		// return get_posts($args);
	}

	public function get_the_speaker_card($include_anchor = false) {

		return sprintf(
			"%s
		<div class='speaker-card'>
			
			 <div class='speaker__headshot'>
			 <div class='speaker__logo-wrapper'>
				<div class='speaker__logo-content'>
				 %s
				 </div>
			</div>
				%s
			</div>
			<div class='speaker__name'>
					 %s
				</div>
			 <div class='speaker__meta'>
				
				<div class='speaker__title'>
				 %s 
				</div>
				<div class='speaker__company'>
				 %s 
				</div>
		</div>
	</div>%s",
			$include_anchor ? "<a href='" . $this->get_permalink() . "'>" : null,
			$this->get_logo(),
			// $this->get_headshot1(),
			$this->get_headshot1(),
			$this->get_name(),
			$this->get_title(),
			$this->get_company(),
			$include_anchor ? "</a>" : null,
		);
	}

	public function the_speaker_card($include_anchor = false) {
		echo $this->get_the_speaker_card($include_anchor);
	}

	public function get_permalink() {
		return get_permalink($this->ID);
	}
	public function the_speaker_card_with_anchor() {
		echo "<a class='speaker__card-anchor' href='" . $this->get_permalink() . "'>"
			. $this->get_the_speaker_card()
			. "</a>";
	}

	public function get_events() {
		return $this->associated_events;
	}


	public function the_events_list() {
		$events = $this->get_future_events();
		if (!$events) return;;
		$html = "<ul class='speaker-events-list'>";
		foreach ($events as $e) {
			$evt = new Event($e);
			$format = "
			<li class='speaker__event'>
				<a href='%s' class='event__title'>%s</a>
			</li>";
			$html .= sprintf($format, $evt->get_permalink(), $evt->post->post_title);
		}
		$html .= "</ul>";
		echo $html;
	}

	public function get_future_events() {
		$events = $this->get_events();
		
		$byniko = new Byniko();
		if (!$events) return false;

		$future = [];
		foreach ($events as $evt) {
			$today_now = strtotime($byniko->future_expiration());
			$start_date = strtotime(get_field('start_date__time', $evt));
			$end_date = strtotime(get_field('end_date__time', $evt));
			// use the end date if we have one;
			$expire_on = $end_date?: $start_date;
			if ($today_now < $expire_on) {
				$future[] = $evt;
			}
		}
		// var_dump($future);
		return $future;
	}


	public function pre_get_events($query) {

		if (is_admin()) {
			return $query;
		}

		if (isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'event' && $query->is_main_query()) {
			// localized for NY based on time settings
			$dateNow = byniko_future_expiration();


			$query->set('posts_per_page', -1);
			$query->set('orderby', 'meta_value');
			$query->set('order', 'ASC');
			$query->set('meta_query', array(
				array(
					'key' => 'start_date__time',
					'compare' => '>',
					'value' => $dateNow,
					'type' => 'DATETIME'
				)
			));
			// $query->set('compare', '>=');
			// $query->set('value', current_time('timestamp'));
			// $query->set('meta_type', 'DATETIME');

			// $query->set(
			// 	'meta_query',
			// 	array(
			// 		array(
			// 			'meta_key'           => 'start_date__time',
			// 			'compare'       => '>=',
			// 			'value'         => $dateNow,//current_datetime()->format('Y-m-d H:i:s'), //current_time('timestamp'),
			// 			'type'          => 'DATETIME',
			// 		),
			// 	)
			// );
		}
		return $query;
	}

	function get_session_info(){
		$info = array(
		'sess_title' => get_field('session_title', $this->ID),
		'sess_desc' => get_field('session_description', $this->ID),
		);
		return $info;

	}
}
