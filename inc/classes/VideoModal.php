<?php

class VideoModal {

	public $video_url;
	public $video_modal_html;
	private $video_modal_trigger;
	public $id;
	private $vimeo_id;
	public function __construct($video_url, $id) {
		$this->video_url                  = $video_url;
		$this->id                         = sanitize_title($id);
		// $this->video_modal_trigger        = $this->get_video_modal_trigger('Play Video', 'testimonial_trigger');
		// $this->vimeo_id 					= $this->get_vimeo_id();
		return $this->video_modal_html    = $this->get_video_modal_html();
	}
	public function get_vimeo_id() {
	}
	public function get_video_modal_trigger($trigger_text = "", $class = "button button--play") {
		return $this->video_url ? $this->get_play_button($trigger_text) : '';
	}
	public function get_video_modal_trigger_old($trigger_text = "", $class = "button button--play") {
		return $this->video_url ? "<div>" . $this->get_play_button($this->id, $trigger_text). " </div>" : '';
	}

	public function get_play_button_old($trigger_id, $trigger_text="") {
			return sprintf(
				'
			<div class="button--play" data-micromodal-trigger=\'%s\'>
	<div class="circle">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
		<polygon points="40,30 65,50 40,70"></polygon>
		</svg>
	</div>
	<div class="trigger_text">%s</div>
	</div>
			',
				$trigger_id,
				$trigger_text
			);
		}
	public function get_play_button( $trigger_text="") {
			return sprintf(
				"
			<div class='button--play' data-micromodal-trigger='video-modal' data-video-url='%s'>
	<div class='circle'>
		<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'>
		<polygon points='40,30 65,50 40,70'></polygon>
		</svg>
	</div>
	<div class='trigger_text'>%s</div>
	</div>
			",
			$this->video_url,
				$trigger_text
			);
		}

	public function get_video_modal_html() {
		return sprintf(
			'
		<div class="modal micromodal-slide video-modal" id="%1$s" aria-hidden="true" data-video-url="%2$s">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="%1$s-title">
        <header class="modal__header">
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="%1$s-video-content">
        </main>
      </div>
    </div>
  </div>
		',
			$this->id,
			$this->video_url
		);
	}
}
