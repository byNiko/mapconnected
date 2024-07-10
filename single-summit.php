<?php

$byniko = new Byniko();
$spships = new Sponsorships();
get_header(); ?>

<main class="annual_summit">
	<section class="hero theme--dark-gradient-1">
		<div class="secondary-nav__wrapper">
			<nav class="secondary-nav">
				<a href="#key-speakers" class="button button--text">Speakers</a>
				<a href="#agenda" class="button button--text">Agenda</a>
				<a href="#sponsorships" class="button button--text">Sponsors</a>
				<a href="#brochure-download" class="button button--text">Download Brochure</a>
				<a href="#travel" class="button button--text">Hotel</a>
			</nav>
		</div>
		<div class="container--narrow landing__container">
			<div class="summit-logo">
				<?=
				wp_get_attachment_image(get_field('summit_logo'), 'full');
				?>
			</div>
			<div class="landing__text">
				Analytics, Data, and Service: <br>
				Fuel For A Customer-First Connected World
			</div>
			<div class="glass">
				<div class=" stats-list">
					<div class="bold-stat">
						<div class="bold-stat__number">200<sup>+</sup></div>
						<div class="bold-stat__title">Attendees</div>
					</div>
					<div class="bold-stat">
						<div class="bold-stat__number">80<sup>+</sup></div>
						<div class="bold-stat__title">Companies</div>
					</div>
					<div class="bold-stat">
						<div class="bold-stat__number">50<sup>+</sup></div>
						<div class="bold-stat__title">Speakers</div>
					</div>
					<div class="bold-stat">
						<div class="bold-stat__number">15<sup>+</sup></div>
						<div class="bold-stat__title">sponsors</div>
					</div>
				</div>
			</div>
			<div class="landing__ctas">
				<heading>
					<h2 class="h2 text-center">Register Now!</h2>
				</heading>
				<div class="flex-row __2x align-center">
					<?php
					$regLinks = get_field('registration_links');
					if ($regLinks) :
						foreach ($regLinks as $link) :
							$title = $link['title'];
							$url = ($link['url']);
							$modal = new ModalIframe($url, $title);
							if ($modal) :
								echo $modal->get_trigger($title, 'button button--accent button--register');
							endif;
						endforeach;
					endif;
					?>
				</div>
			</div>

		</div>
	</section>
	<?php
	if ($key_speakers = get_field('speakers_group')) :
		if (!$key_speakers['hide_key_speakers']) :
			$title = $key_speakers['key_speakers_title'] ?: "Key Speakers";
	?>
			<section id="key-speakers" class="key-speakers">
				<div class="container--narrow">
					<header class="text-center">
						<h2 class="h2 fz-xxl"><?= $title; ?></h2>
					</header>
					<?php get_template_part('/template-parts/summit/key-speakers', null, ['summit_post' => $post]); ?>
				</div>
			</section>
	<?php endif;
	endif; ?>

<section id="title-section" class="title-section">
		<header class="text-center">
			<div class="fz-xxxl fw-extra-bold summit-title">The Future is Now.</div>
			<div class="summit-subtitle">Data Driven Decisions</div>
		</header>
		<div class="container--narrow">
			<div class="flex-row __2x">
				<div class="col">
					<div class="text-block">
						<p>Learn how to get the most out of your data!</p>
						<p>The 2024 Summit will explore powerful strategies for collecting, understanding, and using data to make better decisions, using the latest tools and proven methods.</p>
						<p>Gain valuable insights from industry experts on the latest technology and techniques.</p>
					</div>
					<div class="text-center fw-bold">
						Register Now!
					</div>
					<div class="flex-row __2x align-center mt-1">
						<?php
						$regLinks = get_field('registration_links');
						if ($regLinks) :
							foreach ($regLinks as $link) :
								$title = ($link['title']);
								$url = ($link['url']);
								$modal = new ModalIframe($url, $title);
								if ($modal)
									echo $modal->get_trigger($title, 'button button--accent');
							endforeach;
						endif;
						?>
					</div>
				</div>
				<div class="col flex-column gap-1">
					<div class="video-container">
						<?php //$content =  wp_get_attachment_url(480); 
						?>
						<?php
						// Attributes of the shortcode.
						$attr = array(
							// 'src'        =>  wp_get_attachment_url(480),
							'src'        =>  "https://vimeo.com/968031596?share=copy",
							'height'     => 360,
							'width'      => 640,
							'poster'     => '',
							'loop'       => '',
							'autoplay'   => '',
							'muted'      => 'false',
							'preload'    => 'metadata',
							'class'      => 'wp-video-shortcode',
						);

						echo wp_video_shortcode($attr);
						?>

					</div>
					<div class="flex-row justify--center">
						<a href="<?= get_permalink($byniko->get_page_by_title('Become a Sponsor')); ?>" class="button button--secondary">Become a Sponsor</a>
						<a href="<?= get_permalink($byniko->get_page_by_title('Become a Speaker')); ?>" class="button button--secondary">Become a Speaker</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	if (get_field('attending_companies_group')) :
		// if ($logos = get_field('attending_company_logos')) :
		get_template_part('/template-parts/summit/participating-logos');
	endif;
	?>
	<section id="summary">
		<div class="container--narrow">
			<div class="flex-row __2x inner-container theme--medium-2">
				<div class="col">
					<?php echo wp_get_attachment_image(425, 'full'); ?>
				</div>
				<div class="col">
					<header>
						<h3 class="h3">Agenda Created By Warranty Chain Executives For Warranty Chain Executives</h3>
						<div class="content">
							<p>MAPconnected’s Summit unites the Warranty & Aftercare Services Value Chain and is designed as an annual best practice exchange platform to optimize costs, enhance customer satisfaction and ensure continuous improvement. </p>
							<p>Dive into key case studies on data integration, analysis and action, leveraging top-tier processes and tech innovations that reduce friction and lead to increased product quality. Connect with over 200 peers, gaining priceless insights and practical strategies to fortify your warranty lifecycle roadmap.</p>
						</div>
					</header>
				</div>
			</div>
		</div>
	</section>

	<section id="agenda_highlights">
		<div class="container--narrow">
			<div class="flex-column gap-1">
				<h2 class="h2 text-center">Agenda Highlights</h3>
					<div class="content flex-row __2x">
						<div class="col">
							<dl>
								<dt>AI & PREDICTIVE ANALYTICS </dt>
								<dd>Proven Strategies To Unlock Insights, Increase Efficiency & Empower Automation </dd>
								<dt>ROOT CAUSE ANALYSIS</dt>
								<dd>Using warranty data for improved administration, QUALITY AND SUPPLIER MANAGEMENT and ROOT CAUSE ANALYSIS</dd>
								<dt>TELEMATICS</dt>
								<dd>Best practices on advanced uses of TELEMATICS data</dd>
								<dt>WARRANTY EDITS</dt>
								<dd>Advanced WARRANTY EDITS – what works and what doesn’t?</dd>
							</dl>
						</div>
						<div class="col">
							<dl>
								<dt>LEGAL & REGULATORY</dt>
								<dd>The LEGAL & REGULATORY world continues to evolve. What’s the latest and next?</dd>
								<dt>TECHNICIAN: TOOLS AND DIAGNOSTICS</dt>
								<dd>Training, hiring and retention</dd>
								<dt>OVER-THE-AIR-UPDATES</dt>
								<dd>Staying connected with the customer, OVER-THE-AIR-UPDATES, and input from NHTSA related to field service actions</dd>
								<dt>WARRANTY IMPROVEMENT INITIATIVES</dt>
								<dd>Informative case studies on successful WARRANTY IMPROVEMENT INITIATIVES</dd>
							</dl>
						</div>
					</div>
			</div>
		</div>
	</section>
	<?php
	$args = array(
		'posts_per_page' => 1,
		'post_type' => "testimonial",
		'status' => 'publish',
		'orderby'        => 'rand',
		'post__not_in' => $_SESSION['testimonials_on_page'],
	);
	$q = new WP_Query($args);
	if ($q->have_posts()) : while ($q->have_posts()) : $q->the_post();
			$t = new Testimonial($post);

	?>
			<section id="single-testimonial" class="single-testimonial">
				<div class="container--very-narrow">
					<?= $t->get_single_testimonial_html(); ?>
				</div>
			</section>
	<?php
		endwhile;
	endif;
	wp_reset_query();
	?>
	<section id="agenda" class="scroll-padding--lg">
		<div class="container--very-narrow">
			<div class="flex-column">
				<h2 class="h2 text-center">Introducing New 2024 Formats to Address the Needs of the Rapidly Evolving World </h2>
				<div class="text-content">
					<p>As the Summit expands, MAPconnected stays devoted to crafting and introducing novel thematic tracks and interactive formats, guided by the needs of our industry members and participants. </p>
				</div>
			</div>
			<div class="flex-row justify--center mb-1 mt-1">
				<a href="/about-us#contact-form" class="d-none button button--primary">Get Summit Updates</a>
					<button  data-micromodal-trigger="modal-summit-brochure" class="button button--outline fz-lg">Get the Full Agenda</a>
			</div>
		</div>
		<div class="container mt-1">
			<?php get_template_part('/template-parts/summit/daily-agendas', null, ['summit_post' => $post]); ?>
		</div>
	</section>
	<?php
	if ($speakers_group = get_field('speakers_group')) :
		if ($speakers_repeater = $speakers_group['speakers_repeater']) :
			foreach ($speakers_repeater as $group) :
				$hide = $group['hide_group'];
				$title = $group['summit_speakers_title'];
				$all_speakers = $group['all_speakers'];
				if ($all_speakers && !$hide) :
	?>
					<section id="all-leadership" class="all-leadership">
						<div class="container--narrow">
							<?php
							if ($title) : ?>
								<header class="flex-column text-center">
									<h3 class="h3 text-center"><?= $title; ?></h3>
								</header>
							<?php
							endif; ?>
						</div>

						<div class="container">
							<div class="all-speakers-grid justify--center">
								<?php
								foreach ($all_speakers as $speaker) :
									$sp = new Speaker($speaker);
									echo $sp->get_the_speaker_card();
								endforeach;
								?>
							</div>
						</div>
					</section>
	<?php
				endif;
			endforeach;
		endif;
	endif;
	?>

	<div class="container--narrow mt-1">
		<div id="who-attends">
			<div class="flex-row __2x inner-container theme--medium-2">
				<div class="col">
					<?php echo wp_get_attachment_image(426, 'full'); ?>
					<p class="mt-1 fw-bold">Leading OEMs, Component Manufacturers & Aftermarket Suppliers, and their Network of Retailers, Dealers and Aftercare Services & Technology Providers. </p>
				</div>
				<div class="col">
					<header>
						<h3 class="h3">Who You’ll Meet There</h3>
						<div class="content">

							<div class="fw-semi-bold">Key Job Titles</div>
							<ul>
								<li><strong>Warranty (Factory & Extended):</strong> Strategy | Ops | Claims | Parts Return   </li>
								<li><strong>Finance:</strong> Accruals | Audits</li>
								<li><strong>Purchasing:</strong> Supply Chain | Supplier Cost Sharing</li>
								<li><strong>Data & Analytics:</strong> Systems | Support | Analysts </li>
								<li><strong>Technical:</strong> Field Services | Dealer Administration | EV Services | Training </li>
								<li><strong>Customer:</strong> Recalls | Safety | Campaigns | Customer Service </li>
								<li><strong>Dealer:</strong> Aftersales | Aftercare Services | Reporting | Publications | Training  </li>
								<li><strong>Quality:</strong> Manufacturing | Engineering  </li>
								<li><strong>Marketing:</strong> Customer Experience | Product Design</li>
								<li><strong>Legal:</strong> Regulatory | Compliance </li>
								<li><strong>Insurance & Financial Products</strong> </li>
							</ul>
						</div>
					</header>
				</div>
			</div>
		</div>
	</div>
	</section>
	<section id="must-attend" class="theme--dark-gradient-1">
		<div class="container--single-column">
			<header class="text-center py-1">
				<h2 class="h2 ">Why is Service and Warranty Lifecycle Summit a Must-Attend?</h2>
				<div class="subtitle">MAPconnected's interactive engagement and networking opportunities</div>
			</header>
		</div>
		<div class="container--narrow">
			<div class="flex-row">
				<style>
					.card__image-wrap {
						background-position: center;
						background-size: cover;
						background-repeat: no-repeat;
					}
				</style>
				<div class="image-card flex-column theme--light-1">
					<div class="card__title text-center h3 fw-semi-bold">Connect</div>
					<?php $src = wp_get_attachment_image_src(1075, 'medium'); ?>
					<div class="card__image-wrap" style="background-image: url(<?= $src[0]; ?>);?>"></div>
					<div class="card__content">In-depth discussions across full Warranty Lifecycle filled with Best Practice Presentations & Fireside Chats </div>
				</div>
				<div class="image-card flex-column theme--light-1">
					<div class="card__title text-center h3 fw-semi-bold">Collaborate</div>
					<?php $src = wp_get_attachment_image_src(1076, 'medium'); ?>
					<div class="card__image-wrap" style="background-image: url(<?= $src[0]; ?>);"></div>
					<div class="card__content">Working together through Roundtables to enhance and streamline warranty and aftercare end-to-end experiences</div>
				</div>
				<div class="image-card flex-column theme--light-1">
					<div class="card__title text-center h3 fw-semi-bold">Benchmark</div>
					<?php $src = wp_get_attachment_image_src(396, 'medium'); ?>
					<div class="card__image-wrap" style="background-image: url(<?= $src[0]; ?>);"><img src="//localhost:3000/wp-content/uploads/jj-ying-8bghKxNU1j0-unsplash-e1716688425606-300x100.jpg " alt=""></div>
					<div class="card__content">Exchange latest technology and data usage processes during interactive workshops.</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	$brochure = get_field('brochure_group');
	if ($brochure['download_brochure_label']) :

	?>
		<section id="brochure-download">
			<div class="d-flex justify--center ">
				<div class="text-center theme--medium-1 py-4 px-4 border-radius-2 ">
					<button class="button button--secondary " data-micromodal-trigger="modal-summit-brochure">
						<div class="h4"><?= $brochure['download_brochure_label']; ?></div>
						<?php echo get_summit_brochure_thumb(); ?>
					</button>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	if (have_rows('sponsorship_group')) :
		while (have_rows('sponsorship_group')) :
			the_row();
			if (have_rows('sponsorship_repeater')) : while (have_rows('sponsorship_repeater')) : the_row();
					if (!get_sub_field('hide')) :;
	?>
						<section id="sponsorships" class="sponsorship-levels">
							<header class="text-center">
								<h2 class="h2"><?php the_sub_field('section_title'); ?></h2>
							</header>
							<div class="container">
								<?php get_template_part('/template-parts/summit/sponsorship-levels'); ?>
							</div>
						</section>
	<?php
					endif;
				endwhile;
			endif;
		endwhile;
	endif;

	if ($travel = get_field('travel_group', $post)) :
		get_template_part('/template-parts/summit/travel', null,  ['summit_post' => $post]);
	endif;
	?>

	<!-- <section id="timer">
		<div class="container--single-column">
			<?php //get_template_part('/template-parts/components/countdown-timer'); 
			?>
		</div>
	</section> -->

</main>


<?php
get_footer();
wp_reset_postdata();
