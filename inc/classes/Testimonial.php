<?php
class Testimonial {

	public $has_video;
	public $video_url;
	private $short_quote;
	private $testimonial_type;
	private $title;
	private $company;
	private $company_logo;
	private $vertical_image;
	private $name;
	public $video_embed;
	public $ID;
	public function __construct($post) {
		$this->ID = $post->ID;
		$this->name = $post->post_title;
		$this->has_video = get_field('has_video', $post);
		$this->video_url = ($this->has_video && get_field('video_url', $post)) ? get_field('video_url', $post, false) : false;
		$this->short_quote = get_field('short_quote', $post);
		$this->testimonial_type = get_field('testimonial_type', $post);
		$this->title = get_field('title', $post);
		$this->company = get_field('company', $post);
		$this->company_logo = get_field('company_logo', $post);
		$this->vertical_image = get_field('vertical_image', $post);
		//$this->video_embed = $this->video_url ? apply_filters('the_content', $this->video_url) : false;
	}

	public function get_name() {
		$hide = get_field('hide_names_group_hide_testimonial_names', 'option');
		return  $hide ? false : $this->name;
	}
	public function get_has_video() {
		return $this->has_video;
	}
	/**
	 * The function "get_video_url" returns the video URL if the object has a video and the URL is set.
	 * 
	 * @return The video URL is being returned if the conditions are met (i.e., if the object has a video
	 * and the video URL is set). If the conditions are not met, nothing will be returned explicitly (as
	 * there is no return statement outside the if block).
	 */
	public function get_video_url() {
		if ($this->has_video && $this->video_url)
			return $this->video_url;
		return false;
	}
	public function get_short_quote() {
		return $this->short_quote;
	}
	public function get_testimonial_type() {
		return $this->testimonial_type;
	}
	public function get_title() {
		return $this->title;
	}
	public function get_company() {
		return $this->company;
	}
	public function get_company_logo() {
		return $this->company_logo;
	}
	public function get_company_logo_image() {
		if ($logo = $this->get_company_logo())
			return wp_get_attachment_image($logo['id'], 'medium');
	}
	public function get_vertical_image() {
		return $this->vertical_image;
	}

	public function the_vertical_image() {
		if ($this->get_vertical_image()) {
			echo '<div class="testimonials-card__image-wrapper">';
			echo wp_get_attachment_image($this->vertical_image['id'], 'portrait');
			echo '</div>';
		}
	}

	public function get_single_testimonial_html($wrapper_class = '') {
		$vm = $this->video_url ? new VideoModal($this->video_url, $this->get_name()) : null;
		// $has_video = $vm ?  "testimonial_has_video" : '';

		$footer = byniko_load_template_part('/template-parts/components/testimonial-footer', null, array('testimonial' => $this));
		$video_modal = $vm ? $vm->get_video_modal_html() : '';

		$format = '
		<div class="testimonial__wrap %1$s">

		<div class="testimonial-card">

				<div class="testimonial-card__quote-wrapper">
					<blockquote>
						%2$s
					</blockquote>
					</div>
					%3$s
			</div>
			%4$s
		</div>';
		return sprintf(
			$format,
			$wrapper_class,
			$this->get_short_quote(),
			$footer,
			$video_modal,
			
		);
	}
}
