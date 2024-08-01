<?php

class Sponsor {
	private $name;
	private $ID;
	private $logo_ID;
	private $events;
	private $company_url;
	private $contact_email;
	private $tagline;
	private $description;
	private $slug;
	private $sponsorship_level;
	private $sponsor_page_url;
	public $downloadable_file;
	public function __construct($post) {
		$this->name = $post->post_title;
		$this->ID = $post->ID;
		$this->slug = $post->post_name;
		$this->logo_ID = get_field('logo', $post);
		$this->events = get_field('events', $post);
		$this->company_url = get_field('company_url', $post);
		$this->contact_email = get_field('contact_email', $post);
		$this->tagline = get_field('tagline', $post);
		$this->description = get_field('description', $post);
		$this->sponsorship_level = get_field('sponsorship_level');
		$this->sponsor_page_url = get_home_url() . "/mywarrantynetworkmarketplace";
		$this->downloadable_file = get_field('downloadable_file', $post);
	}

	public function get_ID() {
		return $this->ID;
	}

	public function get_slug() {
		return $this->slug;
	}

	public function get_name() {
		return $this->name;
	}
	public function get_logo_ID() {
		return $this->logo_ID;
	}
	public function get_logo_image() {
		$logoID = $this->get_logo_ID();
		return wp_get_attachment_image($logoID, 'medium');
	}
	public function get_logo_image_src() {
		$logoID = $this->get_logo_ID();
		return wp_get_attachment_image_url($logoID, 'medium');
	}
	public function get_events() {
		return $this->events;
	}
	public function get_company_url() {
		return $this->company_url;
	}
	public function get_contact_email() {
		return $this->contact_email;
	}
	public function get_tagline() {
		return $this->tagline;
	}
	public function get_description() {
		return $this->description;
	}
	public function get_sponsorship_level() {
		return $this->sponsorship_level;
	}

public function get_sponsor_outbound_link(){

}

	public function get_sponsor_page_link() {
		return $this->sponsor_page_url . "/#" . $this->get_slug();
	}
	public function get_sponsor_logo_with_link() {
		if($this->company_url):
		return sprintf(
			'<a class="sponsor__link" href="%s">
								%s
							</a>',
							$this->company_url,
			$this->get_logo_image()
		);
	endif;
	}
}
