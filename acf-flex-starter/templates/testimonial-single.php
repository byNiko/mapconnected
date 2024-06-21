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


foreach($posts as $p):

	$t = new Testimonial($p);
	
	$_SESSION['testimonials_on_page'][] = $p->ID;
	$vertical_image = $t->get_vertical_image();
	$company_logo = $t->get_company_logo();
	$vm = $t->video_url? new VideoModal($t->video_url, $t->get_name()) : null;
	$has_video = $vm?  "testimonial_has_video" : '';

?>
	<section class="single-testimonial <?= $has_video;?>" >
		<?php //var_dump($t->video_url); ?>
		<div class="single-testimonial__wrap">
			
			<blockquote>
				<?= $t->get_short_quote(); ?>
			</blockquote>
			<footer class="text-right testimonial__footer">
				<?php echo $vm? $vm->get_video_modal_trigger('Video Testimonial', 'innerclass') : '';?>
				<div>
				<div class="testimonial__name"><?= $t->get_name(); ?></div>
				<div class="testimonial__title"><cite class="meta"><?= $t->get_title() ?></cite></div>
				<div class="testimonial__company"><cite class="meta"><?= $t->get_company(); ?> </cite></div>
				<div class="testimonial__company-logo"><?= $t->get_company_logo_image(); ?></div>
</div>
			</footer>
		</div>
		<?php echo $vm? $vm->get_video_modal_html() : '';?>
	</section>

<?php endforeach; ?>