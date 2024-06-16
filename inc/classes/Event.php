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
		$this->post                                 = $post;
		$this->reservationLink                      = get_field('reservation_link', $post);
		$this->permalink                            = get_permalink($post);
		$this->description                          = get_field('description', $post);
		$this->time['start']                        = get_field('start_date__time', $post)? new DateTime(get_field('start_date__time', $post)) : false;
		$this->time['end']                          = get_field('end_date__time', $post)? new DateTime(get_field('end_date__time', $post)) : false;
		$this->time['registration_open']            = get_field('registration_opens', $post)? new DateTime(get_field('registration_opens', $post)) : false;
		$this->time['registration_ends']            = get_field('registration_ends', $post)? new DateTime(get_field('registration_ends', $post)) : false;
		$this->time['early_registration_cutoff']    = get_field('early_registration_cutoff', $post)? new DateTime(get_field('early_registration_cutoff', $post)) : false;
		$this->time['regular_registration_cutoff']  = get_field('regular_registration_cutoff', $post)? new DateTime(get_field('regular_registration_cutoff', $post)) : false;
		$this->time['late_registration_begins']     = get_field('late_registration_begins', $post)? new DateTime(get_field('late_registration_begins', $post)) : false;
		$this->sponsors                             = get_field('sponsors', $post);
		$this->speakers                             = get_field('speakers', $post);

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