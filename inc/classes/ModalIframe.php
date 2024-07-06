<?php

class ModalIframe {
	public $id;
	public $iframe_url;

	public function __construct($iframe_url, $id) {
		$this->id           = sanitize_title($id). uniqid();
		$this->iframe_url   = esc_url($iframe_url);

		echo $this->get_modal_html();
	}

	public function get_trigger($label = "Open the Reg Modal", $class="button button--outline") {
		return sprintf(
			'
		<button class="%s" data-micromodal-trigger="%s">
		%s
</button>
		',
		$class,
		$this->id,
		esc_html__($label)
		);
	}

	public function get_modal_html() {
		return sprintf(
			'
		<div class="modal iframe-modal" id="%1$s" aria-hidden="true" data-iframe-url="%2$s">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="%1$s-title">
        <header class="modal__header">
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <div class="modal__content" id="%1$s-registration-content">
        </div>
      </div>
    </div>
  </div>
		',
		$this->id,
		$this->iframe_url
		);
	}
}