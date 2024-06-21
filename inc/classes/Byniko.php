<?php

class Byniko {
	public function __construct() {
		
	}


	public function get_page_by_title($title, $post_type = "page") {
		$posts = get_posts(
			array(
				'post_type'              => $post_type,
				'title'                  => $title,
				'post_status'            => 'publish',
				'numberposts'            => 1,
				'update_post_term_cache' => false,
				'update_post_meta_cache' => false,
				'orderby'                => 'post_date ID',
				'order'                  => 'ASC',
			)
		);

		if (!empty($posts)) {
			return $posts[0];
		}
		return false;
	}


	/**
	 * The function `byniko_future_expiration` calculates a future expiration date by subtracting 43,000
	 * seconds (12 hours) from the current date and time.
	 * 
	 * @return The function `byniko_future_expiration()` is returning a date and time that is 12 hours
	 * earlier than the current date and time. This adjustment is made to keep a post up for the day of the
	 * event by removing 43,000 seconds (equivalent to 12 hours) from the current date and time. The
	 * returned value is in the format 'Y-m-d H:i:s
	 */
	public function future_expiration() {
		$dateNow = wp_date('Y/m/d h:m:s');
		// remove 43000 seconds = 12 hours from comparison to keep the post up for the day of the event.
		return date('Y-m-d H:i:s', strtotime($dateNow) - 43000);
	}

	public function pre_get_events() {
		global $wp_query;
		if (is_admin()) {
			return $wp_query;
		}

		if (
			isset($wp_query->query_vars['post_type'])
			&& $wp_query->query_vars['post_type'] === 'event'
			&& $wp_query->is_main_query()
			&& (!is_singular())
		) {
			// localized for NY based on time settings
			$dateNow = $this->future_expiration();
			$past = get_query_var( 'event-range' )==="past";
			$paged = get_query_var( 'paged' );
			$wp_query->set('order', 'DSC');
			$wp_query->set('orderby', 'meta_value');
			if ($past) {
				$wp_query->set('posts_per_page', 3);
				$wp_query->set('meta_query', array(
					array(
						'key' => 'start_date__time',
						'compare' => '<',
						'value' => $dateNow,
						'type' => 'DATETIME'
					)
				));
				
			} else {
				$wp_query->set('posts_per_page', -1);
				// $wp_query->set('orderby', 'meta_value');
				$wp_query->set('order', 'ASC');
				$wp_query->set('meta_query', array(
					array(
						'key' => 'start_date__time',
						'compare' => '>',
						'value' => $dateNow,
						'type' => 'DATETIME'
					)
				));
			}
		}
		return $wp_query;
	}


	/**
	 * Check if a post is a custom post type.
	 * @param  mixed $post Post object or ID
	 * @return boolean
	 */
	public  function is_custom_post_type($post = NULL) {
		$all_custom_post_types = get_post_types(array('_builtin' => FALSE));

		// there are no custom post types
		if (empty($all_custom_post_types))
			return FALSE;

		$custom_types      = array_keys($all_custom_post_types);
		$current_post_type = get_post_type($post);

		// could not detect current type
		if (!$current_post_type)
			return FALSE;

		return in_array($current_post_type, $custom_types);
	}

	public function reverse_pagination(){
		$paginate = array(
			// 'mid_size'  => 0,
			'prev_text' => 'Next &rarr;',
			'next_text' => '&larr; Previous',
			'type' => 'array'
		);
		// reverse pagination
		$newArr = [];
		$links = paginate_links($paginate);
		if ($links) :
			for ($i = count($links) - 1; $i >= 1; $i--) {
				print_r($links[$i] === "previous");
				$newArr[] = $links[$i];
			}
			foreach ($newArr as $link) :
				echo $link;
			endforeach;
		endif;
	}
}
