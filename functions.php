<?php

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

	wp_enqueue_style(
		'byniko-fonts',
		"//fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap",
		array(),
		null
	);

	if(is_page('annual-summit')){
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

// add_theme_support( 
// 	'editor-font-sizes',
// 	[
// 		[
// 			'name'  => esc_html__( 'Small', 'str' ),
// 			'shortName' => __( 'S', 'str' ),
// 			'size'      => 18,
// 			'slug'  => 'small',
// 		],
// 		[
// 			'name'  => esc_html__( 'Medium', 'str' ),
// 			'shortName' => __( 'N', 'str' ),
// 			'size'      => 21,
// 			'slug'  => 'medium',
// 		],
// 		[
// 			'name'  => esc_html__( 'Large', 'str' ),
// 			'shortName' => __( 'L', 'str' ),
// 			'size'      => 29,
// 			'slug'  => 'large',
// 		],
// 		[
// 			'name'  => esc_html__( 'X-Large', 'str' ),
// 			'shortName' => __( 'XL', 'str' ),
// 			'size'      => 33,
// 			'slug'  => 'xl',
// 		],
// 		[
// 			'name'  => esc_html__( 'XX-Large', 'str' ),
// 			'shortName' => __( 'XXL', 'str' ),
// 			'size'      => 40,
// 			'slug'  => 'xxl',
// 		],
// 		[
// 			'name'  => esc_html__( 'XXX-Large', 'str' ),
// 			'shortName' => __( 'XXXL', 'str' ),
// 			'size'      => 45,
// 			'slug'  => 'xxxl',
// 		],
// 		[
// 			'name'  => esc_html__( 'XXXX-Large', 'str' ),
// 			'shortName' => __( 'XXXXL', 'str' ),
// 			'size'      => "4rem",
// 			'slug'  => 'xxxxl',
// 		],
// 	]
// );
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
 * The function `load_class` is used to dynamically load a PHP class file based on the provided class
 * name.
 * 
 * @param class_name The `load_class` function takes a parameter ``, which is used to
 * construct the file path to include the PHP class file. The file path is generated by appending the
 * `` to the directory path `get_template_directory() . '/inc/classes/'` and adding the
 * `.php
 */

function load_class($class_name) {
	$path_to_file = get_template_directory() . '/inc/classes/' . $class_name . '.php';

	if (file_exists($path_to_file)) {
		require_once $path_to_file;
	}
}

/**
 * Check if a post is a custom post type.
 * @param  mixed $post Post object or ID
 * @return boolean
 */
function is_custom_post_type($post = NULL) {
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
			"ID"=>0,
			"title"=>$type->labels->archives,
			"permalink"=>$link,
			"info"=>"Archive Page"
			);
			$results[] = $arr;
		}
	}
	return $results;
}
add_filter('wp_link_query', 'byniko_add_archive_to_link_query', 9, 2);


function byniko_track_testimonials_on_page_with_session() {
    if(!session_id()) {
        session_start();
    }
	// track testimonials post on page already
	// use as value for 'post__not_in' in wp_queries 
	// where you don't want to repeat testimonials on a page.
	$_SESSION['testimonials_on_page']=[];
	
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


	add_image_size( 'home-slider', 2000, 700, false );