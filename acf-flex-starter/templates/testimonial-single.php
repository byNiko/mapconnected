<?php

$type = get_sub_field('testimonial_type');

$query_args = array(
	'posts_per_page' => 1,
	'post_type' => 'testimonial',
	'post_status' => 'publish',
	'orderby'        => 'rand',
	'post__not_in' => $_SESSION['testimonials_on_page'],
	'tax_query' => array(
		array(
			'taxonomy' => 'testimonial-type',
			'field' => 'name',
			'terms' => $type,
		)
	),
);
$posts = get_posts($query_args);


foreach ($posts as $p) :

	$t = new Testimonial($p);

	$_SESSION['testimonials_on_page'][] = $p->ID;
	$vertical_image = $t->get_vertical_image();
	$company_logo = $t->get_company_logo();
	$vm = $t->video_url ? new VideoModal($t->video_url, $t->get_name()) : null;
	$has_video = $vm ?  "testimonial_has_video" : '';

?>

	<div class="flexible-content-wrap">
		<?= $t->get_single_testimonial_html(); ?>
	</div>

<?php endforeach; ?>