<?php
function byniko_enqueue_acf_starter_scripts() {
	wp_enqueue_style('acf-flex-starter-style', get_template_directory_uri() . '/acf-flex-starter/build/css/style.min.css', array(), '1.0.0');
	wp_enqueue_script('acf-flex-starter-main', get_template_directory_uri() . '/acf-flex-starter/build/js/main.min.js', array('splide-auto-scroll'), '1.0.0', true);

	// should we only load splide assets if needed?
	// currently the testimonial slider exists as well. 
	wp_enqueue_style('splide-style', '//cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), '4.1.4');
	wp_enqueue_script('splide-main', '//cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array('jquery'), '4.1.4', true);
	wp_enqueue_script('splide-auto-scroll', '//cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js', array('splide-main'), '4.1.4', true);
}

add_action('wp_enqueue_scripts', 'byniko_enqueue_acf_starter_scripts');

function my_acf_input_admin_footer() {
?>
	<script type="text/javascript">
		(function($) {


			acf.add_filter('color_picker_args', function(args, $field) {

				// do something to args
				args.palettes = ['#EBF2EC', '#B2CFCB', '#00A41A', '#01590F', '#FFFEFA', '#FAF3DF', '#FFDF8C', '#FFC223']


				// return
				return args;

			});

		})(jQuery);
	</script>
<?php

}

add_action('acf/input/admin_footer', 'my_acf_input_admin_footer');

/**
 * Rename the layout row title in admin section for flexible content. 
 * This makes finding layouts easier.
 *	
 * @param  [string] $title
 * @param  [arr] $field
 * @param  [arr] $layout
 * @param  [int] $i
 * @return void
 */
function byniko_acf_fields_flexible_content_layout_title($title, $field, $layout, $i) {
	// assign possible variables
	$image = get_sub_field('image');
	$text = get_sub_field('section_heading');
	if (!$text) $text = get_sub_field('admin_label');

	if ($text || $image) {
		// Remove layout name from title.
		

		// Display thumbnail image.
		// if ($image = get_sub_field('image')) {
		// 	$title .= '<div class="thumbnail"><img src="' . esc_url($image['sizes']['thumbnail']) . '" height="36px" /></div>';
		// }

		// load text sub field
		if ($text) {
			$title = '';
			$title .= $layout['label'] . ' | <b>' . esc_html($text) . '</b>';
		}
	}
	return $title;
}
add_filter('acf/fields/flexible_content/layout_title/name=layouts', 'byniko_acf_fields_flexible_content_layout_title', 10, 4);
/**
 * Rename the layout row title in admin section for flexible content. 
 * This makes finding layouts easier.
 *	
 * @param  [string] $title
 * @param  [arr] $field
 * @param  [arr] $layout
 * @param  [int] $i
 * @return void
 */
function byniko_acf_fields_flexible_content_container_title($title, $field, $layout, $i) {
	// assign possible variables
	$image = get_sub_field('image');
	$text = get_sub_field('section_heading');
	if (!$text) $text = get_sub_field('admin_label');

	if ($text || $image) {
		// Remove layout name from title.
		

		// // Display thumbnail image.
		// if ($image = get_sub_field('image')) {
		// 	$title .= '<div class="thumbnail"><img src="' . esc_url($image['sizes']['thumbnail']) . '" height="36px" /></div>';
		// }

		// load text sub field
		if ($text) {
			$title = '';
			$title .= $layout['label'] . ' | <b>' . esc_html($text) . '</b>';
		}
	}
	return $title;
}
add_filter('acf/fields/flexible_content/layout_title/name=content_container', 'byniko_acf_fields_flexible_content_container_title', 10, 4);


add_filter('acf/load_value/key=field_66e1c57f98d30',  'byniko_secondary_nav_acf_load_my_defaults', 10, 3);

function byniko_secondary_nav_acf_load_my_defaults($value, $post_id, $field) {

  if ($value === false) {

    $value = array();

    $value[] = array(
      'field_66e1c61e98d36' => true,
      'field_66e1c60c98d34' => 'Speakers',
      'field_66e1c61598d35' => 'key-speakers',
    );
    $value[] = array(
      'field_66e1c61e98d36' => true,
      'field_66e1c60c98d34' => 'Agenda',
      'field_66e1c61598d35' => 'agenda',
    );
    $value[] = array(
      'field_66e1c61e98d36' => true,
      'field_66e1c60c98d34' => 'Sponsors',
      'field_66e1c61598d35' => 'sponsorships',
    );
    $value[] = array(
      'field_66e1c61e98d36' => true,
      'field_66e1c60c98d34' => 'Download Brochure',
      'field_66e1c61598d35' => 'brochure-download',
    );
    $value[] = array(
      'field_66e1c61e98d36' => true,
      'field_66e1c60c98d34' => 'Hotel',
      'field_66e1c61598d35' => 'travel',
    );
    $value[] = array(
      'field_66e1c61e98d36' => true,
      'field_66e1c60c98d34' => 'Tickets!',
      'field_66e1c61598d35' => 'primary-reg-link-section',
    );
  }

  return $value;
}