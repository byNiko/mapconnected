<?php
/**
 * The function `byniko_has_sidebar` checks if the current page is a post type archive for 'xxxx' or
 * uses the page template 'xxxxxx'.
 * 
 * returns: function `byniko_has_sidebar()` is returning an array containing the results of two
 * conditional checks:
 */

function byniko_has_sidebar(){

	$has_sidebar = array(
		is_singular('event'),
		is_singular('post'),
		is_post_type_archive(
			array('')
		),
		is_home(),
		// is_archive(),
		is_page_template(
			// array( 'custom-template-3.php' )
		)
	);
	return in_array(true, $has_sidebar);
}
function byniko_sidebar_body_classes($classes) {
	
if( byniko_has_sidebar()) {
		return array_merge($classes, array('has-sidebar'));
	} else {
		return $classes;
		// return  array_merge($classes, array('no-sidebar'));
	}
}
add_filter('body_class', 'byniko_sidebar_body_classes');