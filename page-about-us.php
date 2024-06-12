<?php
get_header();

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css" integrity="sha512-UuQ/zJlbMVAw/UU8vVBhnI4op+/tFOpQZVT+FormmIEhRSCnJWyHiBbEVgM4Uztsht41f3FzVWgLuwzUqOObKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/regular.min.css" integrity="sha512-KYEnM30Gjf5tMbgsrQJsR0FSpufP9S4EiAYi168MvTjK6E83x3r6PTvLPlXYX350/doBXmTFUEnJr/nCsDovuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/solid.min.css" integrity="sha512-Hp+WwK4QdKZk9/W0ViDvLunYjFrGJmNDt6sCflZNkjgvNq9mY+0tMbd6tWMiAlcf1OQyqL4gn2rYp7UsfssZPA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<main id="primary" class="site-main">
	<section class="container--very-narrow">
		<header class="text-center">
			<h1 class="fz-display">Warranty Shouldn’t Be So Hard.</h1>
		</header>
		<div class="content">
			<div class="fz-md">
				<p>Imagine a world where immediate feedback is the norm and best practices are exchanged fluidly. </p>
				<p>That’s our goal. We connect warranty and aftercare companies of all sizes to share real-world experiences, jointly tackling issues and discovering smarter ways to work. </p>
			</div>
			<div class="flex-row justify--center">
				<a href="#" class="button button--primary button--md">Join Now!</a>
				<a href="#" class="button button--secondary button--outline button--md">Contact Us!</a>
			</div>
		</div>
		<div class="content">
			<header class="text-center">
				<h2 class="h2">Our Mission</h2>
			</header>
			Our mission is to nurture a professional network that provides an engaging interactive forum to share best practices across the motor vehicle service and warranty ecosystem with similar-minded industry peers using the <strong>give</strong> and <strong>take</strong> premise.
		</div>
	</section>
	<style>
			.give_take {
				position:relative;
				overflow: hidden;
			}
			.bg_ampersand {
				position:absolute;
				left: 50%;
				transform: translate(-50%, -50%);
				font-size: 21vw;
    line-height: 1;
    font-weight: 800;
    top: 50%;
	opacity: .5;
			}
			.give_take .content {
				text-align: center;
				max-width: 300px;
				padding: 1rem;
			}
		</style>
	<section class="give_take theme--dark-gradient-1">
		
		<div class="bg_ampersand">&</div>
		<div class="container--narrow">
			<div class="flex-row justify--center">
				<div class="content">
					<div class="h2 text-uppercase fw-bold">Give</div>
					<p>You share your expertise and experience, as do your peers</p>
				</div>
				<div class="content">
					<div class="h2 text-uppercase fw-bold">Take</div>
					<p>You receive valuable insights and expertise from your peers</p>
				</div>
			</div>
		</div>
	</section>
	<section id="mapconnected-network" style="background-image: url('/src/images/mapconnected-network.jpg'); background-size:cover;">
		<div class="container--very-narrow ">
			
		</div>
		<div class="container--very-narrow">
			<div class="content">
				<p class="fz-md">We are soliciting your stories that share and validate hard won successes and innovative warranty and service operations insights.</p>
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
			<div class="flex-row __4x">
				<?php
				load_class("Speaker");
				$speakers = new Speaker();
				$speakers = $speakers->get_speakers();
				foreach ($speakers as $sp) :
					$s = new Speaker($sp);
				?>
					<div class="flex-column">
						<div class="speaker__logo text-center">
							<?= $s->get_logo(); ?>
						</div>
						<div class="speaker__headshot">
							<?= $s->get_headshot1(); ?>
						</div>
						<div class="speaker__meta">
							<div class="speaker__name">
								<?= $s->get_name(); ?>
							</div>
							<div class="speaker__title fz-xs">
								<?= $s->get_title(); ?>
							</div>
						</div>
					</div>
				<?php endforeach; 	?>
			</div>
		</div>
	</section>
	<section id="speaker-form" class="theme--dark-gradient-1">
		<div class="container--very-narrow justify--center align-center">
			<header class="text-center">
				<h2 class="h2">Become a Speaker </h2>
			</header>
			<?php echo FrmFormsController::get_form_shortcode(array('id' => 4)); ?>
		</div>
	</section>

	<?php
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', 'page');

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

</main><!-- #main -->
<?php //get_sidebar('sidebar'); 
?>
<?php get_footer(); ?>