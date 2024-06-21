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
			<h1 class="fz-display">Become a Sponsor!</h1>
			<h2 class="h2 subtitle">Expand Your Professional Brand Through Our Network of Motor Vehicle Warranty Professionals</h2>
		</header>
		<div class="content">
			<p class="fz-md">Mapconnected Offers A Year-Round Unique Platform To Expand Your Professional Brand Along The Motor Vehicle Warranty And Aftercare Services Chain.</p>
		</div>
	</section>
	<section id="curent_prev_sponsors">
		<header>
			<h3 class="h3 text-center">Snapshot of Current and Previous Sponsors</h2>
		</header>
		<div class="container theme--medium-1 py-1">
			<?php
			get_template_part(
				'/acf-flex-starter/layouts/sponsor_logos_slider',
				null,
				array('sponsorship_levels' => ['gold', 'silver', 'bronze'])
			);
			?>
		</div>
	</section>
	<section id="elevate-brand">
		<div class="container--narrow">
			<h2 class="h2 text-center">Elevate Your Brand.</h2>
			<div class="flex-row __2x">
				<dl class="col">
					<dt>Direct Access</dt>
					<dd>Direct access to Warranty Chain, Engineering, Technical Services, Customer Care, Aftersales And Aftercare Executives.</dd>

					<dt>Create a Presence</dt>
					<dd>Establish A Thought Leadership Position In The Service & Warranty Lifecycle Industry.</dd>
					<dt>Understand Your Customers</dt>
					<dd>Gain Firsthand Knowledge To Leverage OEM, Parts Manufacturers And Dealer Driven Priorities & Agendas.</dd>

				</dl>
				<dl class="col">
					<dt>Brand Awareness</dt>
					<dd>Build Brand awareness in all promotional MAPconnected Member Network Activities</dd>
					<dt>MAPconnected Member Network</dt>
					<dd>Online Profile with direct access 24/7 in the member’s forum</dd>
					<dt>Gain Insight</dt>
					<dd>Test/Demo New Ideas For Warranty Chain Lifecycle Technologies</dd>
					<dt>Partnerships</dt>
					<dd>Grow strategic relationships with alliance partners</dd>

				</dl>
			</div>
		</div>

	</section>
	<section id="sponsorship-opportunities" class="theme--medium-1">
		<div class="container--narrow">
			<div class="flex-row justify--center __2x">
				<div class="col-0"><button class="button button--icon">Annual Summit</button></div>
				<div class="col-0"><button class="button button--icon">MyWarrantyNetwork Hub</button></div>
			</div>
		</div>
	</section>
	<section>
		<div class="container--very-narrow">
			<header class="text-center">
				<?php echo wp_get_attachment_image(982, 'full'); ?>
				<h2 class="h2"> Sponsorship Options</h2>
			</header>
			<div class="content">
				<p>MAPconnected’s Summit unites the Warranty & Aftercare Value Chain and is designed as an annual platform to exchange ideas to optimize costs, enhance customer satisfaction and ensure continuous improvement</p>
			</div>
		</div>
		<div class="container--narrow">
			<div class="theme--light-2">
				<h4 class="h4 text-center">Stand Out Amongst Our:</h4>
				<div class="flex-row">
					<div class="col">50 Speaker</div>
					<div class="col">200+ Attendees</div>
					<div class="col">80+ Unique Companies</div>
					<div class="col">15+ Tech Expo Booths</div>
				</div>
			</div>
		</div>
	</section>
	<section class="icon-grid__wrapper">
		<div class="container--very-narrow">
			<div class="icon-grid grid __3x justify--center">
				<div class="icon-card flex-column">
					<div class="card__icon"><i class="fa-classic fa-regular fa-thumbs-up" aria-hidden="true"></i></div>
					<div class="flex-column">
						<div class="card__title">Speaking Opportunities with Clients</div>
						<div class="card__content"></div>
					</div>
				</div>
				<div class="icon-card flex-column">
					<div class="card__icon"><i class="fa-classic fa-solid fa-filter-circle-dollar" aria-hidden="true"></i></div>
					<div class="flex-column">
						<div class="card__title">Tech Expo and Booths</div>
						<div class="card__content"></div>
					</div>
				</div>
				<div class="icon-card flex-column">
					<div class="card__icon"><i class="fa-classic fa-solid fa-rocket" aria-hidden="true"></i></div>
					<div class="flex-column">
						<div class="card__title">Host Roundtables</div>
						<div class="card__content"></div>
					</div>
				</div>
				<div class="icon-card flex-column">
					<div class="card__icon"><i class="fa-classic fa-solid fa-rocket" aria-hidden="true"></i></div>
					<div class="flex-column">
						<div class="card__title">Meal Sponsorship</div>
						<div class="card__content"></div>
					</div>
				</div>
				<div class="icon-card flex-column">
					<div class="card__icon"><i class="fa-classic fa-solid fa-rocket" aria-hidden="true"></i></div>
					<div class="flex-column">
						<div class="card__title">Roundtable Discussion Leaders or Chairmanship</div>
						<div class="card__content"></div>
					</div>
				</div>
				<div class="icon-card flex-column">
					<div class="card__icon"><i class="fa-classic fa-solid fa-rocket" aria-hidden="true"></i></div>
					<div class="flex-column">
						<div class="card__title">Workshop Learning Lab Leaders</div>
						<div class="card__content"></div>
					</div>
				</div>
				<div class="icon-card flex-column">
					<div class="card__icon"><i class="fa-classic fa-solid fa-rocket" aria-hidden="true"></i></div>
					<div class="flex-column">
						<div class="card__title">Network Hosted Webinars</div>
						<div class="card__content"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="brochure-cta" class="brochure-cta">
		<div class="container--single-column">
			<div class="flex-row justify--center">
				<div class="brochure-cta__wrapper">
					<div class="inner-container text-center theme--medium-2 border-radius-2">
						<p>Need More Information to Make Your Decision?</p>
						<p>Ask me for our brochure and customized packages.</p>
						<?= wp_get_attachment_image(983, 'medium'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="container--narrow">
			<div class="flex-row __2x">
				<div class="col d-flex">
					<?= wp_get_attachment_image(425, 'full'); ?>
				</div>
				<div class="col flex-column justify--center">
					<?= wp_get_attachment_image(982, 'medium'); ?>
					<p>Get More Info about becoming a Sponsor</p>
					<a href="" class="button button--primary">Request Sponsor Packages</a>
				</div>
			</div>
		</div>
	</section>
	<section id="mywarrantynetworkhub" class="theme--medium-2">
		<header class="container--very-narrow">
			<h2 class="h2 text-center flex-column">
				<?= wp_get_attachment_image(838, 'medium'); ?>
				Thrive in our MyWarrantyNetwork Hub
			</h2>
		</header>
		<div class="container--very-narrow">
			<div class="content">
				<p>The Hub is where Warranty Lifecycle Professionals go to gain insights and seek the best technology partners to reshape their warranty and aftercare end-to-end experiences. </p>
				<p>The publicly accessible Marketplace Directory handles project area needs such as: Warranty Administration | Purchasing & Supplier Recovery | Parts Return & Quality Analysis </p>
			</div>
			<div class="content">
				<h3 class="h3">Benefits</h3>
			</div>
			<section class="icon-grid__wrapper">
				<div class="container--very-narrow">
					<div class="icon-grid grid __3x justify--center">
						<div class="icon-card flex-column">
							<div class="card__icon"><i class="fa-classic fa-regular fa-thumbs-up" aria-hidden="true"></i></div>
							<div class="flex-column">
								<div class="card__title">Speaking Opportunities with Clients</div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card flex-column">
							<div class="card__icon"><i class="fa-classic fa-solid fa-filter-circle-dollar" aria-hidden="true"></i></div>
							<div class="flex-column">
								<div class="card__title">Tech Expo and Booths</div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card flex-column">
							<div class="card__icon"><i class="fa-classic fa-solid fa-rocket" aria-hidden="true"></i></div>
							<div class="flex-column">
								<div class="card__title">Host Roundtables</div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card flex-column">
							<div class="card__icon"><i class="fa-classic fa-solid fa-rocket" aria-hidden="true"></i></div>
							<div class="flex-column">
								<div class="card__title">Meal Sponsorship</div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card flex-column">
							<div class="card__icon"><i class="fa-classic fa-solid fa-rocket" aria-hidden="true"></i></div>
							<div class="flex-column">
								<div class="card__title">Roundtable Discussion Leaders or Chairmanship</div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card flex-column">
							<div class="card__icon"><i class="fa-classic fa-solid fa-rocket" aria-hidden="true"></i></div>
							<div class="flex-column">
								<div class="card__title">Workshop Learning Lab Leaders</div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card flex-column">
							<div class="card__icon"><i class="fa-classic fa-solid fa-rocket" aria-hidden="true"></i></div>
							<div class="flex-column">
								<div class="card__title">Network Hosted Webinars</div>
								<div class="card__content"></div>
							</div>
						</div>
					</div>
				</div>
			</section>
	</section>
	<section>
		<div class="container--fluid">
			<div class="testimonial-slider">
				<?php
				get_template_part(
					'/acf-flex-starter/templates/testimonial-slider',
					null,
					array()
				);
				?>
			</div>
		</div>
	</section>
	<section id="sponsor-form" class="theme--dark-gradient-1 last-section py-4">
		<div class="container--very-narrow justify--center align-center">
			<header class="text-center">
				<h2 class="fz-display">Become a Sponsor </h2>
			</header>
			<?php echo FrmFormsController::get_form_shortcode(array('id' => 2)); ?>
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