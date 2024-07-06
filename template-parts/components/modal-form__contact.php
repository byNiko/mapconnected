
<?php
$contact_form = FrmFormsController::get_form_shortcode( array( 'id' => 7 ) );
$modal = new Modal('Contact Form', "Contact Us", $contact_form );
echo $modal->get_modal_trigger("Contact Us", "button button--accent");
echo $modal->get_modal_html(' theme--dark-1 contact-form-modal');
?>
<?php //echo FrmFormsController::get_form_shortcode( array( 'id' => 7 ) ); ?>