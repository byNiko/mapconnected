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
		$hide = get_field('hide_names_group_hide_speaker_names', 'option');
		return $hide? false : $this->name;
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
	public function get_headshot1(){
		if($ID = $this->get_headshot1_object()['ID'])
		return wp_get_attachment_image($ID,'portrait');
	}
	public function get_the_headshot1(){
		echo $this->get_headshot1();
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

	public function get_the_speaker_card($include_anchor = false){
		
		return sprintf("%s
		<div class='speaker-card'>
			<div class='speaker__logo-wrapper'>
				<div class='speaker__logo-content'>
				 %s
				 </div>
			</div>
			 <div class='speaker__headshot'>
				%s
			</div>
			 <div class='speaker__meta'>
				<div class='speaker__name'>
					 %s
				</div>
				<div class='speaker__title'>
				 %s 
				</div>
		</div>
	</div>%s",
		$include_anchor? "<a href='". $this->get_permalink(). "'>" : null,
		$this->get_logo() ,
		$this->get_headshot1(),
		$this->get_name(),
		$this->get_title(),
		$include_anchor? "</a>": null,
	);					
							
	}

	public function the_speaker_card($include_anchor = false){
		echo $this->get_the_speaker_card($include_anchor);
	}

	public function get_permalink(){
		return get_permalink($this->ID);
	}
	public function the_speaker_card_with_anchor(){
		echo "<a class='speaker__card-anchor' href='" . $this->get_permalink(). "'>" 
		. $this->get_the_speaker_card()
		. "</a>";
	}

	public function get_events(){
		return $this->associated_events;
	}

	public function the_events_list(){
		$events = $this->get_events();
		if (!$events) return;

;		$html = "<ul class='speaker-events-list'>";
		foreach($events as $e){
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

}