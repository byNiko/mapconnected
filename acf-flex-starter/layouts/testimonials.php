<?php
// Get ACF values
//$video_url = get_field('has_video')? get_field('video_url') : null;

// var_dump($testionial_type);

$template_args = array(
	'testimonial_type' => get_sub_field('testimonial_type'),
	'style' => get_sub_field('style'),
);

// $query_args = array(
// 	'posts_per_page' => ($template_args['style'] === "single") ? 1 : 15,
// 	'post_type' => 'testimonial',
// 	'post_status' => 'published',
// 	'orderby'        => 'rand',
// 	'post__not_in' => $_SESSION['testimonials_on_page'],
// 	'tax_query' => array(
// 		array(
// 			'taxonomy' => 'testimonial-type',
// 			'field' => 'name',
// 			'terms' => $template_args['testimonial_type'],
// 		)
// 	),
// );
// $query = new WP_Query($query_args);
get_template_part(
	'acf-flex-starter/templates/testimonial',
	$template_args['style'],
	$template_args
);
