<?php

class Modal {
	private $modalId, $title, $content;
	public function __construct($modalId, $title, $content)
	{
		$this->modalId    = sanitize_title($modalId);
		$this->title      = $title;
		$this->content    = $content;
	}

	public function get_modal_trigger($text, $classes, $modalId = null){
		$modalId = $modalId ?: $this->modalId;
		$format = '<button class="%3$s" data-micromodal-trigger="%1$s">%2$s</button>';
		return sprintf($format, 
		$modalId,
		$text,
		$classes
	);
	}

	public function get_modal_html($classes){
		$format = '<div class="modal micromodal-slide %4$s" id="%1$s"  aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="%1$s-title">
        <header class="modal__header">
          <h2 class="modal__title" id="%1$s-title">
           %2$s
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="%1$s-content">
          %3$s
        </main>
      </div>
    </div>
  </div>';
  
  return sprintf($format, 
  $this->modalId,
  $this->title,
  $this->content,
  $classes
);
	}
}