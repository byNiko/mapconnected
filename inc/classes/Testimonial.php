<?php
class Testimonial {

	private $has_video;
	private $video_url;
	private $short_quote;
	private $testimonial_type;
	private $title;
	private $company;
	private $company_logo;
	private $vertical_image;
	private $name;
	public function __construct($post){
		$this->name = $post->post_title;
		$this->has_video = get_field('has_video', $post);
		$this->video_url = get_field('video_url', $post);
		$this->short_quote = get_field('short_quote', $post);
		$this->testimonial_type = get_field('testimonial_type', $post);
		$this->title = get_field('title', $post);
		$this->company = get_field('company', $post);
		$this->company_logo = get_field('company_logo', $post);
		$this->vertical_image = get_field('vertical_image', $post);
	}

	public function get_name(){
		return $this->name;
	}
	public function get_has_video(){
		return $this->has_video;
	}
	public function get_video_url(){
		return $this->video_url;
	}
	public function get_short_quote(){
		return $this->short_quote;
	}
	public function get_testimonial_type(){
		return $this->testimonial_type;
	}
	public function get_title(){
		return $this->title;
	}
	public function get_company(){
		return $this->company;
	}
	public function get_company_logo(){
		return $this->company_logo;
	}
	public function get_company_logo_image(){
		if($this->get_company_logo()['id'])
		return wp_get_attachment_image($this->get_company_logo()['id'], 'medium');
	}
	public function get_vertical_image(){
		return $this->vertical_image;
	}

}