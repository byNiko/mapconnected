<?php
// $args are from get_template_part include
load_class("Testimonial");
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


foreach($posts as $p):

	$t = new Testimonial($p);
	$_SESSION['testimonials_on_page'][] = $p->ID;
	$vertical_image = $t->get_vertical_image();
	$company_logo = $t->get_company_logo();
?>
	<section class="single-testimonial">
		<div class="single-testimonial__wrap">
			<blockquote>
				<?= $t->get_short_quote(); ?>
			</blockquote>
			<footer class="text-right testimonial__footer">
				<div class="testimonial__name"><?= $t->get_name(); ?></div>
				<div class="testimonial__title"><cite class="meta"><?= $t->get_title() ?></cite></div>
				<div class="testimonial__company"><cite class="meta"><?= $t->get_company(); ?> </cite></div>
				<div class="testimonial__company-logo"><?= $t->get_company_logo_image(); ?></div>
			</footer>
		</div>
	</section>

<?php endforeach; ?>