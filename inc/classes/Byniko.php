<?php

class Byniko {
	private $archive_posts_per_page = 8;
	public function __construct() {
		// return $this;
	}

	public function url_match($compareString) {
		// Function to get the current URL
		function getCurrentUrl() {
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			return $currentUrl;
		}

		// Get the current URL
		$currentUrl = getCurrentUrl();

		// Compare the current URL with the string
		return $currentUrl === $compareString;
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

	public function archive_query() {
	}
	public function get_total_number_archive_pages() {
		$args = array(
			'post_type' => 'event',
			'status' => "publish",
			'orderby' => 'meta_value',
			'meta_key' => 'start_date__time',
			'posts_per_page' => $this->archive_posts_per_page
		);
		$q = new WP_Query($args);
		return $q->max_num_pages;
	}
	public function pre_get_events() {
		global $wp_query;
		if (is_admin()) {
			return $wp_query;
		}
		if ($wp_query->is_search) {
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
			$event_range = get_query_var('event-range');
			$paged = get_query_var('paged');

			switch ($event_range) {
				case "past":
					$wp_query->set('order', 'DSC');
					$wp_query->set('orderby', 'meta_value');
					$wp_query->set('meta_key', 'start_date__time');
					$wp_query->set('posts_per_page', $this->archive_posts_per_page);
					// $wp_query->set('paged', $paged?: $wp_query->max_num_pages);
					$wp_query->set('meta_query', array(
						array(
							'key' => 'start_date__time',
							'compare' => '<',
							'value' => $dateNow,
							'type' => 'DATETIME',
						)
					));
					break;
				case "all":
					$wp_query->set('posts_per_page', -1);
					$wp_query->set('orderby', 'meta_value');
					$wp_query->set('order', 'ASC');
					break;
				default:
					$wp_query->set('posts_per_page', -1);
					$wp_query->set('orderby', 'meta_value');
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

	public function reverse_pagination() {
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

	public function get_video_modal_html() {
		return sprintf(
			'
		<div class="modal micromodal-slide video-modal" id="video-modal" aria-hidden="true" data-video-url="">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="%1$s-title">
        <header class="modal__header">
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="video-modal-video-content">
        </main>
      </div>
    </div>
  </div>',
  null
		);
	}

	public function split_name($name) {
		$name = trim($name);
		$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
		$first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
		return array($first_name, $last_name);
	}
}


// /**
//  * INCLUDE CUSTOM POST TYPES IN SEARCH RESULTS
//  */
// function wpdocs_cpt_in_search( $query ) {
//     if ( ! is_admin() && $query->is_main_query() ) {
//         if ( $query->is_search ) {
//             $query->set( 'post_type', array( 'event' ) );
//         }
//     }
// }

// add_action( 'pre_get_posts', 'wpdocs_cpt_in_search' );