<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package byniko
 */
// load_class("Byniko");
$byniko = new Byniko();
get_header();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css" integrity="sha512-UuQ/zJlbMVAw/UU8vVBhnI4op+/tFOpQZVT+FormmIEhRSCnJWyHiBbEVgM4Uztsht41f3FzVWgLuwzUqOObKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/regular.min.css" integrity="sha512-KYEnM30Gjf5tMbgsrQJsR0FSpufP9S4EiAYi168MvTjK6E83x3r6PTvLPlXYX350/doBXmTFUEnJr/nCsDovuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/solid.min.css" integrity="sha512-Hp+WwK4QdKZk9/W0ViDvLunYjFrGJmNDt6sCflZNkjgvNq9mY+0tMbd6tWMiAlcf1OQyqL4gn2rYp7UsfssZPA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<main id="primary" class="site-main py-4">
	<?php 
 // nested flexible content
 if (have_rows('layouts')) :  while (have_rows('layouts')) : the_row();
		 $layout = get_row_layout();
		 // Increment the counter for each slider
		 if ($layout == 'slider' || $layout == 'testimonials') {
			 $slider_counter++;
			 set_query_var('slider_id', 'slider-' . $slider_counter);
		 }

		 // Include the layout file
		 get_template_part('acf-flex-starter/layouts/' . $layout);

	 endwhile;

 endif;
	?>
	<section>
		<div class="container--very-narrow">
			<div class="content">
			</div>
			<div class="flex-row __2x justify--center">
				<a href="#speaker-form" class="button button--primary">Apply to Speak</a>
				<a href="<?= get_permalink($byniko->get_page_by_title('Become a Sponsor')); ?> " class="button button--primary">Apply to Sponsor</a>
			</div>
		</div>
	</section>
	<?php
	if (have_rows('speakers_reward_details')) : ?>
		<section id="speaker-reward-pacakage" class="speaker-reward-package__wrapper mt-1">
			<div class="container--single-column">
				<div class="inner-container surface theme--medium-1 border-radius-4">
					<?php
					if (have_rows('speakers_reward_details')) :
						while (have_rows('speakers_reward_details')) : the_row();
							echo "<header class='text-center'>";
							echo "<h2 class='h2 fw-extra-bold'> " . get_sub_field('title') . "</h3>";
							echo "<div class='d-ib pill fz-md theme--bright-1 fw-semi-bold'> Valued at " . get_sub_field('valued_at') . "</div>";
							echo "</header>";
							if (have_rows('detail_item')) :
					?>
								<dl class="dotted mt-1">
									<?php
									while (have_rows('detail_item')) :
										the_row();
										$name = get_sub_field('name');
										$value =  get_sub_field('value');

									?>
										<div class="dotted-connector">
											<dt> <?= $name ?> </dt>
											<?php if ($value) : 	?>
												<div class="dots"></div>
												<dd> <?= $value ?></dd>
											<?php endif; ?>
										</div>
									<?php
									endwhile;
									?>
								</dl>
					<?php
							endif;
						endwhile;
					endif;
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<section>
		<div class="container--fluid">
			<div class="testimonial-slider">
				<?php get_template_part('/acf-flex-starter/templates/testimonial-slider', null, array()); ?>
			</div>
		</div>
	</section>

	<section class="theme--medium-1 mt-1">
		<div class="container--narrow">
			<header class="h2 text-center"><?php the_field('speaker_list_title');?></header>
			<div class="flex-row __5x speakers-list">
				<?php

				$speakers = get_field('speakers_group');
				if ($speakers) :
					foreach ($speakers as $sp) :
						$s = new Speaker($sp);
						$s->the_speaker_card();

					endforeach;
				endif;
				?>
			</div>
		</div>
	</section>
	<section id="speaker-form" class="theme--dark-gradient-1 last-section py-4">
		<div class="container--very-narrow justify--center align-center">
			<header class="text-center">
				<h2 class="fz-display">Become a Speaker </h2>
			</header>
			<?php echo FrmFormsController::get_form_shortcode(array('id' => 4)); ?>
		</div>
	</section>

	<?php
	// while (have_posts()) :
	// 	the_post();

	// 	get_template_part('template-parts/content', 'page');

	// 	// If comments are open or we have at least one comment, load up the comment template.
	// 	if (comments_open() || get_comments_number()) :
	// 		comments_template();
	// 	endif;

	// endwhile; // End of the loop.
	?>

</main><!-- #main -->
<?php //get_sidebar('sidebar'); 
?>
<?php get_footer(); ?>