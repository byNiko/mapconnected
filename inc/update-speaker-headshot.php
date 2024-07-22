<?php
/**
 * Change Yoas OG:image url on speakerpages IF they ahve a secondary image
 * 
 * **/

function acf_set_featured_image($value, $post_id, $field) {
	if ($value != '') {
		//Add the value which is the image ID to the _thumbnail_id meta data for the current post
		update_post_meta($post_id, '_thumbnail_id', $value);
	}

	return $value;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=primary_headshot', 'acf_set_featured_image', 10, 3);
add_filter('acf/update_value/name=secondary_headshot', 'acf_set_featured_image', 10, 3);

/**
 * 
 * 
 * This is unneeded since  we're dynamically setting the featured image on that page usibng
 * acf_set_featured_image
 */
// add_filter( 'wpseo_opengraph_image', 'byniko_yoast_change_opengraph_image_url', 10, 1 );
// function byniko_yoast_change_opengraph_image_url( $img ) {

// 	if( is_singular( 'speaker') ) {
// 		global $post;
// 		$s = new Speaker($post);
// 		$img = $s->get_headshot2_url('large');
// 	}
// 	return $img;
// };
/**
 * Alter the OpenGraph image width for a single post type.
 */
// function byniko_change_opengraph_image_width( $width ) {
// 	if( is_singular( 'speaker') ) {
// 		global $post;
// 		$s = new Speaker($post);
// 		$arr = $s->get_secondary_image_data();
// 		$width = $arr['sizes']['large']['width'];    
// 	}
// 	return $width;
// }
/**
 * Alter the OpenGraph image height for a single post type.
 */
// function byniko_change_opengraph_image_height ( $height ) {
//     if( is_singular( 'speaker') ) {
// 		global $post;
// 		$s = new Speaker($post);
// 		$arr = $s->get_secondary_image_data();
// 		$height = $arr['sizes']['large']['height'];    
// 	}
//     return $height;
// }
 /**
 * Alter the OpenGraph image type for a single post type.
 */
// function byniko_change_opengraph_image_type ( $type ) {
// 	if( is_singular( 'speaker') ) {
// 		global $post;
// 		$s = new Speaker($post);
// 		$arr = $s->get_secondary_image_data();
// 		$type = $arr['sizes']['large']['mime-type'];  
// 	}
//     return $type;
// }

// add_filter( 'wpseo_opengraph_image_width', 'byniko_change_opengraph_image_width' );
// add_filter( 'wpseo_opengraph_image_height', 'byniko_change_opengraph_image_height' );
// add_filter( 'wpseo_opengraph_image_type', 'byniko_change_opengraph_image_type' );