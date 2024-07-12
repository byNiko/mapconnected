<?php

// autoload classes
spl_autoload_register(function ($class_name) {
	get_template_part("/inc/classes/$class_name");
});
// add_filter('date_i18n', function ($date, $format, $timestamp, $gmt) {
// 	return wp_date($format, $timestamp);
// 	}, 99, 4);
// date_default_timezone_set( 'America/New_York' );

function byniko_query_vars($qvars) {
	$qvars[] = 'event-range';
	$qvars[] = 'updated';
	return $qvars;
}
add_filter('query_vars', 'byniko_query_vars');


/**
 * byniko functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package byniko
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function byniko_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on byniko, use a find and replace
		* to change 'byniko' to the name of your theme in all the template files.
		*/
	// load_theme_textdomain('byniko', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	// add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');
	add_theme_support('responsive-embeds');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'byniko'),
			'menu-2' => esc_html__('Secondary', 'byniko'),
			'menu-3' => esc_html__('Footer-1', 'byniko'),
			'menu-4' => esc_html__('Footer-2', 'byniko'),
			'menu-5' => esc_html__('Footer-3', 'byniko'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'byniko_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
// function byniko_content_width() {
// 	$GLOBALS['content_width'] = apply_filters('byniko_content_width', 1080);
// }
// add_action('after_setup_theme', 'byniko_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function byniko_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'byniko'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'byniko'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'byniko_widgets_init');



function byNiko_add_preconnect_links() {
	$domains = array(
		// Cloudflare analytics
		// 'static.cloudflareinsights.com',
		// Google tracking
		'//fonts.googleapis.com',
		'//fonts.gstatic.com',
		// 'www.googletagmanager.com',
		// 'www.google-analytics.com',
		// 'stats.g.doubleclick.net',
		// Monsterinsights
		// 'a.opmnstr.com',
		// 'a.omappapi.com',
		// 'api.omappapi.com',
	);

	foreach ($domains as $domain) {
?>
		<link rel="preconnect" href="<?= $domain; ?>" crossorigin>
	<?php
	}
}
/**
 * Enqueue  fonts and set recommended preconnect links
 */
function byniko_enqueue_fonts() {
	wp_enqueue_style('dashicons');
	wp_enqueue_style(
		'byniko-fonts',
		"//fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap",
		array(),
		null
	);

	if (is_page('annual-summit')) {
		wp_enqueue_style(
			'byniko-montserrat',
			"fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap",
			array(),
			null
		);
	}


	add_action('wp_head', 'byNiko_add_preconnect_links', 5);
}

add_action('wp_enqueue_scripts', 'byniko_enqueue_fonts');

// allow google fonts to show up in Gutenberg edtiro
add_action('enqueue_block_editor_assets', 'byniko_enqueue_fonts');


/**
 * Enqueue scripts and styles.
 */
function byniko_scripts() {
	// asset versioning from npm build process
	$asset_file = include(get_stylesheet_directory() . '/dist/main.asset.php');
	wp_enqueue_style(
		'byniko-style',
		get_stylesheet_directory_uri() . "/dist/main.css",
		array(),
		$asset_file['version']
	);

	wp_enqueue_script(
		'byniko-script',
		get_template_directory_uri() . '/dist/main.js',
		array(),
		$asset_file['version'],
		true
	);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'byniko_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/sidebar-functions.php';
require get_template_directory() . '/inc/acf-functions.php';
include(get_template_directory() . '/acf-flex-starter/helper-functions.php');

// only load block assets when needed
add_filter('should_load_separate_core_block_assets', '__return_true');

add_action('enqueue_block_editor_assets', 'my_editor_assets', 100);

function my_editor_assets() {
	// asset versioning from npm build process
	$asset_file = include(get_stylesheet_directory() . '/dist/main.asset.php');
	$css_file = get_stylesheet_directory_uri() . "/dist/main.css";

	wp_enqueue_style(
		'byniko-style',
		$css_file,
		array('wp-edit-blocks'),
		$asset_file['version']
	);
}


function byniko_custom_archive_title($title) {
	// Remove any HTML, words, digits, and spaces before the title.
	return str_replace("Archives: ", '', strip_tags($title));
}
add_filter('get_the_archive_title', 'byniko_custom_archive_title');

/**
 * The function `remove_breadcrumb_title` removes the title from the last breadcrumb link in WordPress
 * SEO breadcrumbs.
 * 
 * @param link_output The `link_output` parameter in the `remove_breadcrumb_title` function is a string
 * that represents the output of a single breadcrumb link generated by the Yoast SEO plugin. The
 * function checks if the `link_output` contains the class `breadcrumb_last` and if it does, it empties
 * the
 * 
 * @return The `remove_breadcrumb_title` function is returning an empty string `""` if the
 * `` contains the string 'breadcrumb_last'.
 */
add_filter('wpseo_breadcrumb_single_link', 'remove_breadcrumb_title');
function remove_breadcrumb_title($link_output) {
	if (strpos($link_output, 'breadcrumb_last') !== false) {

		$link_output = null;
	}
	return $link_output;
}

/**
 * add custom post type archive links to page query search results in Link Fields
 *
 * @param  arr $results
 * @param  arr $query
 * @return arr
 */
function byniko_add_archive_to_link_query($results, $query) {
	$all_custom_post_types = get_post_types(array('_builtin' => FALSE, 'public' => TRUE), 'name');
	//error_log(print_r($all_custom_post_types, true));
	if (!empty($all_custom_post_types)) {
		foreach ($all_custom_post_types as $type) {
			error_log(print_r($type, true));
			$link = get_post_type_archive_link($type->name);
			error_log(print_r($link, true));
			$arr = array(
				"ID" => 0,
				"title" => $type->labels->archives,
				"permalink" => $link,
				"info" => "Archive Page"
			);
			$results[] = $arr;
		}
	}
	return $results;
}
add_filter('wp_link_query', 'byniko_add_archive_to_link_query', 9, 2);


function byniko_track_testimonials_on_page_with_session() {
	if (!session_id()) {
		session_start();
	}
	// track testimonials post on page already
	// use as value for 'post__not_in' in wp_queries 
	// where you don't want to repeat testimonials on a page.
	$_SESSION['testimonials_on_page'] = [];
}
add_action('init', 'byniko_track_testimonials_on_page_with_session', 1);

function byniko_add_secondary_logo($wp_customize) {
	// add a setting 
	$wp_customize->add_setting('secondary_logo');
	// Add a control to upload the hover logo
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'secondary_logo', array(
		'label' => 'Upload 2nd Logo',
		'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
		'settings' => 'secondary_logo',
		'priority' => 8 // show it just below the custom-logo
	)));
}

add_action('customize_register', 'byniko_add_secondary_logo');


add_image_size('home-slider', 2000, 700, false);
add_image_size('portrait', 250, 375, true);
add_image_size('footer-gallery', 280, 110, true);


function byniko_get_theme_image($filename, $atts) {
	$path = get_template_directory_uri() . "/src/images/" . $filename;
	$att = '';
	foreach ($atts as $a => $value) {
		$att .= " $a = '$value'";
	}
	return "<img src='$path' $att/>";
}


/**
 * The function `byniko_fb_opengraph` generates Open Graph meta tags for a WordPress post of type
 * 'event', including title, description, type, URL, site name, and image.
 * 
 * @return If the function `byniko_fb_opengraph()` is called and the condition
 * `is_singular(array('event'))` is met, then the Open Graph meta tags for the title, description,
 * type, URL, site name, and image will be outputted. If the condition is not met (i.e., if the post
 * type is not 'event'), the function will return nothing.
 */
function byniko_fb_opengraph() {
	global $post;

	if (is_singular(array('event'))) {
		if (has_post_thumbnail($post->ID)) {
			$img_src = wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'medium');
		} else {
			// fallback
			$img_src = get_stylesheet_directory_uri() . '/img/opengraph_image.jpg';
		}
		if ($excerpt = $post->post_excerpt) {
			$excerpt = strip_tags($post->post_excerpt);
			$excerpt = str_replace("", "'", $excerpt);
		} else {
			$excerpt = get_bloginfo('description');
		}
	?>
		<meta property="og:title" content="<?php echo the_title(); ?>" />
		<meta property="og:description" content="<?php echo $excerpt; ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="<?php echo the_permalink(); ?>" />
		<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>" />
		<meta property="og:image" content="<?php echo $img_src; ?>" />

<?php
	} else {
		return;
	}
}
add_action('wp_head', 'byniko_fb_opengraph');

add_action('pre_get_posts', function () {
	$byniko = new Byniko();
	$byniko->pre_get_events();
});


function byniko_acf_admin_enqueue_styles() {
	wp_enqueue_style('my-acf-input-css', get_stylesheet_directory_uri() . '/inc/acf-style.css', false, '1.0.0');
	// wp_enqueue_script( 'my-acf-input-js', get_stylesheet_directory_uri() . '/js/my-acf-input.js', false, '1.0.0' );
}

add_action('acf/input/admin_enqueue_scripts', 'byniko_acf_admin_enqueue_styles');


function byniko_cpt_custom_search_filter($query) {
	if ($query->is_search && !is_admin()) {
		if ($post_type = get_query_var('post_type'))
			$query->set('post_type', $post_type);
	}
	return $query;
}
add_filter('pre_get_posts', 'byniko_cpt_custom_search_filter');



function acf_set_featured_image($value, $post_id, $field) {
	print_r($value);

	if ($value != '') {
		//Add the value which is the image ID to the _thumbnail_id meta data for the current post
		update_post_meta($post_id, '_thumbnail_id', $value);
	}

	return $value;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=primary_headshot', 'acf_set_featured_image', 10, 3);


add_action('acf/init', 'my_acf_form_init');
function my_acf_form_init() {

	// Check function exists.
	if (function_exists('acf_register_form')) {

		// Register form.
		acf_register_form(array(
			'id'       => 'new-speaker',
			'post_id'  => 'new_post',
			'new_post' => array(
				'post_title' => "Pending Intake",
				'post_type'   => 'speaker',
				'post_status' => 'pending',
			),
			'post_title'  => false,
			'post_content' => false,
			// 'return' => home_url(),
			'submit_value'	=> 'Submit Speaker Info',
			'updated_message' => __("<h1>Post updated</h1><div>Thanks! We got your info</div>", 'acf'),
			'uploader' => 'wp', // wp | baseic
		));
	}
}



// Auto add and update Title field for Event Post Type
// todo: take a look at this to figure out the issue we've got
// https://wordpress.stackexchange.com/questions/105926/rewriting-post-slug-before-post-save
function byniko_custom_event_post_title_and_slug($post_id) {

	if (get_post_type() == 'speaker') {
		$my_post = array();
		$my_post['ID'] = $post_id;
		$my_post['post_title'] = get_field('name', $post_id);
		$my_post['post_name'] = sanitize_title($my_post['post_title']);

		remove_action('save_post', 'byniko_custom_event_post_title_and_slug', 10, 3);
		wp_update_post($my_post);
		add_action('save_post', 'byniko_custom_event_post_title_and_slug', 10, 3);
		//do_action('acf/save_post' , $post_id);
		// wp_redirect( home_url(), 301);

	}
}

// run after ACF saves the $_POST['fields'] data
add_action('acf/save_post', 'byniko_custom_event_post_title_and_slug', 20);



add_shortcode('new-speaker-form', 'byniko_new_speaker_front_end_form');

function byniko_new_speaker_front_end_form() {
	acf_form_head();
	ob_start();

	acf_form('new-speaker');
	return ob_get_clean();
}


function add_slug_body_class($classes) {
	global $post;
	if (isset($post)) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter('body_class', 'add_slug_body_class');


add_action('wp_footer', 'byniko_footer_modal');
function byniko_footer_modal() {
	//get_template_part('/template-parts/components/modal-form__contact');
}


function byniko_load_template_part($template_name, $part_name = null, $args = []) {
	ob_start();
	get_template_part($template_name, $part_name, $args);
	$var = ob_get_contents();
	ob_end_clean();
	return $var;
}

function get_transparent_img_src() {
	return "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=";
}

function get_summit_brochure_thumb() {
	$thumb = '';
	if ($brochure_group = get_field('global_summit_group', 'options')) :
		if ($img = $brochure_group['summit_brochure_thumbnail']) :
			$thumb = wp_get_attachment_image($img, 'medium', false, ['loading' => 'lazy', 'class'=>"mt-1"]);
		endif;
	endif;
	return $thumb;
}
