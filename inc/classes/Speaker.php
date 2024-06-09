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
		if(!$speaker) return;
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
		return $this->name;
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
		return wp_get_attachment_image($this->company_logo_object['ID'], 'medium');
	}
	public function get_headshot1_object() {
		return $this->headshot1_object;
	}
	public function get_headshot1(){
		return wp_get_attachment_image($this->get_headshot1_object()['ID'],'full');
	}
	public function get_headshot2_object() {
		return $this->headshot2_object;
	}
	public function get_headshot2(){
		return wp_get_attachment_image($this->get_headshot2_object()['ID'],'full');
	}
	public function get_associated_events() {
		return $this->associated_events;
	}

	public function get_speakers($args = array()){
		$default_args = array(
				'posts_per_page' => -1,
				'post_type' => 'speaker',
				'post_status' => 'publish',
				'orderby'        => 'rand',
				'post__not_in' => [],
				// 'tax_query' => array(
				// 	array(
				// 		'taxonomy' => 'testimonial-type',
				// 		'field' => 'name',
				// 		'terms' => 'Brand Member',
				// 	)
				// ),
		);
		$args = array_merge($default_args, $args);
		return get_posts($args);
	}
}
