<?php

class Event{
	public $post;
	private $reservationLink;
	private $permalink;
	private $description;
	private $time;
	private $sponsors;
	private $speakers;

	public function __construct($post)
	{
		$this->post = $post;
		$this->reservationLink = get_field('reservation_link', $post);
		$this->permalink = get_permalink($post);
		$this->description = get_field('description', $post);
		$this->time['start'] = !empty(get_field('start_date__time', $post))? new DateTime(get_field('start_date__time', $post)) : false;;
		$this->time['end'] = !empty(get_field('end_date__time', $post))? new DateTime(get_field('end_date__time', $post)) : false;;
		$this->time['registration_open'] = get_field('registration_opens', $post);
		$this->time['registration_ends'] = get_field('registration_ends', $post);
		$this->time['early_registration_cutoff'] = get_field('early_registration_cutoff', $post);
		$this->time['regular_registration_cutoff'] = get_field('regular_registration_cutoff', $post);
		$this->time['late_registration_begins'] = get_field('late_registration_begins', $post);
		$this->sponsors = get_field('sponsors', $post);
		$this->speakers = get_field('speakers', $post);

	}

	public function get_reservation_link(){
		return $this->reservationLink ;
	}
	public function get_permalink(){
		return $this->permalink ;
	}
	public function get_description(){
		return $this->description ;
	}
	public function get_time($type = null){
		return $this->time ;
	}
	public function get_sponsors(){
		return $this->sponsors ;
	}
	public function get_speakers(){
		return $this->speakers ;
	}
}