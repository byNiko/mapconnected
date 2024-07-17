
<!-- <button data-micromodal-trigger="modal-summit-brochure">open</button> -->
<!-- [1] -->
<div class="modal micromodal-slide modal-form modal-form--summit-brochure" id="modal-summit-brochure" aria-hidden="true">
    <div class="modal__overlay " tabindex="-1" data-micromodal-close>
      <div class="modal__container theme--dark-1 py-1 scrollbar-styled" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-summit-brochure-title">
            Get the Summit Brochure!
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-summit-brochure-content">
        <?php echo FrmFormsController::get_form_shortcode( array( 'id' => 8 ) ); ?>
        </main>
      </div>
    </div>
  </div>