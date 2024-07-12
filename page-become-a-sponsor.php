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
	<section class="theme--false container--very-narrow">
		<header class="text-center">
			<h1 class="fz-display">Become a Sponsor!</h1>
			<h2 class="h2 subtitle">Expand Your Professional Brand Through Our Network of Motor Vehicle Warranty Professionals</h2>
		</header>
		<div class="content">
			<p class="fz-md">MAPconnected offers a year-round unique platform to expand your professional brand along the Motor Vehicle Warranty and Aftercare Services Chain. </p>
		</div>
	</section>
	<?php
	$sponsors = get_field('sponsors_group');
	$count = count($sponsors);
	$group1 = array_slice($sponsors, 0, intval(ceil($count / 2)) );
	$group2 = array_slice($sponsors, intval(floor($count / 2) ));
	if ($sponsors) :
	?>
		<section id="curent_prev_sponsors" class="p-relative">
			<header>
				<h3 class="h3 text-center">Snapshot of Current and Previous Sponsors</h2>
			</header>
			<div class="container theme--medium-1 py-1">
				<?php
				get_template_part(
					'/acf-flex-starter/layouts/sponsor_logos_slider',
					null,
					array(
						'sponsors' => $group1,
						'slider_options' => ['perPage' => "8"]
					)
				);
				?>
			</div>
			<div class="container theme--medium-1 py-1">
				<?php
				get_template_part(
					'/acf-flex-starter/layouts/sponsor_logos_slider',
					null,
					array(
						'sponsors' => $group2,
						'slider_options' => ['perPage' => "8", 'autoScroll' => ['speed'=>'-.25']]
					)
				);
				?>
			</div>
		</section>
	<?php endif; ?>
	<section id="elevate-brand" class="theme--false">
		<div class="container--very-narrow">
			<h2 class="h2 text-center">Elevate Your Brand</h2>
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
	<section id="sponsorship-opportunities" class="theme--medium-1 py-1">
		
		<div class="container--narrow">
		<header>
			<h2 class="h2 text-center">Two Ways to Sponsor!</h2>
		</header>
			<div class="flex-row justify--center">
				<a href="#summit" class="button button--icon button--lg">Annual Summit</a>
				<a href="#mywarrantynetworkhub" class="button button--icon button--lg">MyWarrantyNetwork Hub</a>
			</div>
		</div>
	</section>
	<section id="summit" class="theme--false">
		<div class="container--very-narrow">
			<header class="text-center">
				<?php echo wp_get_attachment_image(982, 'full'); ?>
				<h2 class="h2">Benefits</h2>
			</header>
			<div class="content">
				<p>MAPconnected’s Summit unites the Warranty & Aftercare Value Chain and is designed as an annual platform to exchange ideas to optimize costs, enhance customer satisfaction and ensure continuous improvement.</p>
			</div>
		</div>
		<div class="container--narrow d-none">
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
	<section class="icon-grid__wrapper ">
		<div class="container--very-narrow theme--medium-1 py-1">
			<div class="icon-grid grid __3x justify--center p-relative">
				<div class="icon-card icon-top">
					<div class="card__icon"><i class="fa-classic fa-regular fa-thumbs-up" aria-hidden="true"></i></div>
					<div class="flex-column">
						<div class="card__title">Case Studies with Clients</div>
						<div class="card__content"></div>
					</div>
				</div>
				<div class="icon-card icon-top">
					<div class="card__icon"><i class="fa-classic fa-solid fa-filter-circle-dollar" aria-hidden="true"></i></div>
					<div class="flex-column">
						<div class="card__title">Tech Expo and Booths</div>
						<div class="card__content"></div>
					</div>
				</div>
				<div class="icon-card icon-top">
					<div class="card__icon"><i class="fa-classic fa-solid fa-rocket" aria-hidden="true"></i></div>
					<div class="flex-column">
						<div class="card__title">Host Roundtables</div>
						<div class="card__content"></div>
					</div>
				</div>
				<div class="icon-card icon-top">
					<div class="card__icon"><i class="fa-solid fa-utensils"></i></div>
					<div class="flex-column">
						<div class="card__title">Meal Sponsorship</div>
						<div class="card__content"></div>
					</div>
				</div>
				<div class="icon-card icon-top">
					<div class="card__icon"><i class="fa-solid fa-people-arrows"></i></div>
					<div class="flex-column">
						<div class="card__title">Roundtable Discussion Leaders or Chairmanship</div>
						<div class="card__content"></div>
					</div>
				</div>
				<div class="icon-card icon-top">
					<div class="card__icon"><i class="fa-solid fa-chalkboard-user"></i></div>
					<div class="flex-column">
						<div class="card__title">Workshop Learning Lab Leaders</div>
						<div class="card__content"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="brochure-cta" class="brochure-cta mt-1 theme--false py-1">
		<div class="container--single-column">
			<div class="flex-row justify--center">
				
			</div>
		</div>
	</section>
	<section class="theme--false py-1">
		<div class="container--narrow mt-1">
			<div class="flex-row __2x">
				<div class="col d-flex">
					<?= wp_get_attachment_image(425, 'full'); ?>
				</div>
				<div class="col flex-column justify--center">
					<?= wp_get_attachment_image(982, 'medium'); ?>
					<p>Get More Info about becoming a Sponsor</p>
					<a href="#sponsor-form" class="button button--primary">Request Sponsor Packages</a>
				</div>
			</div>
		</div>
	</section>
	<section id="mywarrantynetworkhub" class="theme--medium-2">
		<header class="container--very-narrow">
			<h2 class="h2 text-center flex-column">
				<?= wp_get_attachment_image(838, 'full'); ?>
				Thrive in our MyWarrantyNetwork Hub
			</h2>
		</header>
		<div class="container--very-narrow">
		
			<div class="content">
				<p>The Hub is where Warranty Lifecycle Professionals go to gain insights and seek the best technology partners to reshape their warranty and aftercare end-to-end experiences. </p>
				<p>The publicly accessible Marketplace Directory gives you heightened exposure and access to Surveys, Audits, and Consulting project requests in areas such as Warranty Administration | Purchasing & Supply Chain | Parts Return & Quality Analysis | Aftersales & Aftercare Services. </p>
			</div>
			<header class="text-center">
					<h2 class="h2">Benefits</h2>
				</header>
				<section class="icon-grid__wrapper  ">
		<div class="container--very-narrow theme--light-1 py-1">
			<div class="icon-grid grid __3x justify--center">
						<div class="icon-card icon-top">
							<div class="card__icon"><i class="fa-solid fa-network-wired"></i></div>
							<div class="flex-column">
								<div class="card__title">Speaking Opportunities with Clients</div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card icon-top">
							<div class="card__icon"><i class="fa-solid fa-address-book"></i></div>
							<div class="flex-column">
								<div class="card__title">Marketplace Directory Listing </div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card icon-top">
							<div class="card__icon"><i class="fa-solid fa-handshake"></i></div>
							<div class="flex-column">
								<div class="card__title">Co Promote Webinars</div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card icon-top">
							<div class="card__icon"><i class="fa-solid fa-comments"></i></div>
							<div class="flex-column">
								<div class="card__title">Messaging Forum 24/7</div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card icon-top">
							<div class="card__icon"><i class="fa-solid fa-circle-nodes"></i></div>
							<div class="flex-column">
								<div class="card__title">Sponsor Surveys & Promote Tech Blog</div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card icon-top">
							<div class="card__icon"><i class="fa-solid fa-ticket"></i></div>
							<div class="flex-column">
								<div class="card__title">Summit Ticket Discounts</div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card icon-top">
							<div class="card__icon"><i class="fa-solid fa-rectangle-ad"></i></div>
							<div class="flex-column">
								<div class="card__title">Website & Email Advertising </div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card icon-top">
							<div class="card__icon"><i class="fa-solid fa-clipboard-user"></i></div>
							<div class="flex-column">
								<div class="card__title">Host Club Study </div>
								<div class="card__content"></div>
							</div>
						</div>
						<div class="icon-card icon-top">
							<div class="card__icon"><i class="fa-solid fa-filter-circle-dollar"></i></div>
							<div class="flex-column">
								<div class="card__title">Project Request Leads </div>
								<div class="card__content"></div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<footer class="mt-1 text-center">
					<a href="/packages/?tab_id=mywarrantynetwork-sponsorships" class="button button--accent kbutton--outline">Check out the Sponsor Packages!</a>	
				</footer>
	</section>
	<section class="theme-- d-none">
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
		<div class="container--narrow justify--center align-center">
			<header class="text-center">
				<h2 class="fz-display">Become a Sponsor </h2>
			</header>
				<div class="flex-row">
					<div class="col col-66">
			<?php echo FrmFormsController::get_form_shortcode(array('id' => 2)); ?>
			</div>
			<div class="brochure-cta__wrapper col">
					<div class="py-1 px-1 text-center theme--medium-2 border-radius-2">
						<p>Need More Information to Make Your Decision?</p>
						<p>Ask me for our brochure and customized packages.</p>
						<?= get_summit_brochure_thumb(); ?>
					</div>
				</div>
				</div>
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
<?php get_footer();
