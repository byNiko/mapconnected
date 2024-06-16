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

get_header();

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css" integrity="sha512-UuQ/zJlbMVAw/UU8vVBhnI4op+/tFOpQZVT+FormmIEhRSCnJWyHiBbEVgM4Uztsht41f3FzVWgLuwzUqOObKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/regular.min.css" integrity="sha512-KYEnM30Gjf5tMbgsrQJsR0FSpufP9S4EiAYi168MvTjK6E83x3r6PTvLPlXYX350/doBXmTFUEnJr/nCsDovuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/solid.min.css" integrity="sha512-Hp+WwK4QdKZk9/W0ViDvLunYjFrGJmNDt6sCflZNkjgvNq9mY+0tMbd6tWMiAlcf1OQyqL4gn2rYp7UsfssZPA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<main id="primary" class="site-main">
	<section class="container--very-narrow">
		<header class="text-center">
			<h1 class="fz-display">Become a Speaker!</h1>
			<h2 class="h2 subtitle">Join us and showcase your thought leadership.</h2>
		</header>
		<div class="content">
			<p class="fz-md">Do you have experience and expertise that would benefit the network? If so, why not share
				them. We have lots of opportunities open: </p>
		</div>

	</section>
	<section>
		<div class="container--very-narrow ">
			<div class="icon-grid grid __3x justify--center align-center theme--medium-1 border-radius-4">
				<div class="icon-card flex-column">
					<div class="card__icon"><i class="fa-classic fa-regular fa-thumbs-up" aria-hidden="true"></i></div>
					<div class="flex-column">
						<div class="card__title">Virtual Event<br>Round Robin Host</div>
						<div class="card__content"></div>
					</div>
				</div>
				<div class="icon-card flex-column">
					<div class="card__icon"><i class="fa-classic fa-solid fa-filter-circle-dollar" aria-hidden="true"></i></div>
					<div class="flex-column">
						<div class="card__title">Annual Summit</div>
						<div class="card__content"></div>
					</div>
				</div>
				<div class="icon-card flex-column">
					<div class="card__icon"><i class="fa-classic fa-solid fa-rocket" aria-hidden="true"></i></div>
					<div class="flex-column">
						<div class="card__title">Webinars</div>
						<div class="card__content"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="container--very-narrow">
			<div class="content">
				<p class="fz-md">We are soliciting your stories that share and validate hard won successes and
					innovative warranty and service operations insights.</p>
			</div>
			<div class="flex-row __2x justify--center">
				<div class="d-flex"><a href="" class="button button--primary">Apply to Speak</a></div>
				<div class="d-flex"><a href="" class="button button--primary">Apply to Sponsor</a></div>
			</div>
		</div>
	</section>
	<section>
		<div class="container--fluid">
			<div class="testimonial-slider">
				<?php get_template_part('/acf-flex-starter/templates/testimonial-slider', null, array()); ?>
			</div>
		</div>
	</section>
	<section class="theme--medium-1">
		<div class="container--narrow">
			<header class="h2 text-center">Thought Leadership At It’s Best! </header>
			<div class="flex-row __4x speakers-list">
				<?php
				load_class("Speaker");
				$speakers = new Speaker();
				$speakers = $speakers->get_speakers();
				foreach ($speakers as $sp) :
					$s = new Speaker($sp);
					$s->the_speaker_card();

				endforeach;
				?>
			</div>
		</div>
	</section>
	<section id="speaker-form" class="theme--dark-gradient-1 last-section py-4">
		<div class="container--very-narrow justify--center align-center">
			<header class="text-center">
				<h2 class="h2">Become a Speaker </h2>
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