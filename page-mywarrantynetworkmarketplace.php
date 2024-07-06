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
<main id="primary" class="site-main">
	<section class="hero py-4">
		<header class="container--narrow">
			<h1 class="h1 text-center ">
				<div>Welcome to</div>
				<?= wp_get_attachment_image(838, 'full'); ?>
			</h1>
			<h3 class="h4 subtitle text-center py-1">
				At MAPconnected, we're deeply grateful for the incredible support of our sponsors.
			</h3>
		</header>
		<?php
		$marketplace_sponsors = get_field('sponsor_slider');
		if ($marketplace_sponsors && $marketplace_sponsors['sponsors_group']) :
		?>
			<section id="marketplace_sponsor_logos_wrap py-1">
				<div class="container--very-narrow theme--medium-1">
					<h4 class="text-center">Marketplace Sponsors </h4>
					<?php

					get_template_part(
						'/acf-flex-starter/layouts/sponsor_logos_slider',
						null,
						array(
							'sponsors' => $marketplace_sponsors['sponsors_group'],
							'slider_options' => ['perPage' => "12"]
						)
					);
					?>
					<div class="flex-row justify--center">
						<a href="#marketplace" class="text-link fw-semi-bold">Show me the marketplace</a>
					</div>
				</div>
			</section>
		<?php
		endif;
		?>
	<div class="leader-content py-1">
		<div class="container--single-column fz-md">
			<p>They share our commitment to fostering a thriving community of professionals and driving innovation in the motor vehicle warranty and aftercare industry.</p>
			<p>This page connects you with these valuable partners. We encourage you to explore their websites and learn more about the exceptional products and services they can offer you to strengthen your warranty and aftercare services lifecycles. </p>
			<div class="two-button-cta">
				<div class="flex-row  justify--center">
					<div class="flex-column">
						<span class="fz-sm fw-semi-bold">Have a Project or Training need</span>
						<a href="/about-us#contact-form" class="button button--primary has-shadow-1 ">Contact Us</a>
					</div>
					<div class="flex-column">
						<span class="fz-sm fw-semi-bold">Become a Marketplace Sposnor</span>
						<a href="/become-a-sponsor#sponsor-form" class="button button--primary button--outline has-shadow-1">Sign Me Up!</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>

	<?php

	$args = array(
		'post_type' => ['event', 'post'],
		'status' => 'publish'
	);
	$q = new WP_Query($args);
	if ($q->have_posts()) :
	?>
		<style>
			.main.articles {
				grid-area: main;
			}

			.main-sidebar {
				grid-area: sidebar
			}

			.grid-sidebar {
				display: grid;
				grid-template-columns: 1fr 250px;
				grid-template-areas:
					"main sidebar"
			}
		</style>
		<section class="blog_and_news__wrapper theme--medium-1 py-4">
			<header class="text-center">
				<h2 class="fz-display">News and Events</h2>
			</header>
			<div class="container-fluid">
				<div class="articles main">

					<?php while ($q->have_posts()) : $q->the_post(); ?>
						<?php $event = new Event($post); ?>
						<div class="article">
							<h3 class="h3 event--title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="event--description"><?= wp_trim_words($event->get_description(), 15); ?> </div>
						</div>
					<?php endwhile;
					wp_reset_query(); ?>
				</div>
			</div>
			<footer class="text-center">
				<a href="/news" class="button button--text">View all News</a>
			</footer>
		</section>
		<?php

		if ($marketplace_sponsors && $marketplace_sponsors['sponsors_group']) :
		?>
			<section id="marketplace" class="py-4">
				<div class="container--narrow">
					<div class="grid __2x justify--center">
						<?php foreach ($marketplace_sponsors['sponsors_group'] as $sp) : ?>
							<?php $sponsor = new Sponsor($sp); ?>
							<div class="sponsor-item" id="<?= $sponsor->get_slug(); ?>">
								<div class="sponsor__logo">
									<?php echo $sponsor->get_logo_image(); ?>
								</div>
								<div class="sponsor__name">
									<?php the_title(); 	?>
								</div>
								<div class="sponsor__description collapse-panel" id="<?= $sponsor->get_slug() . '__collapse'; ?>" aria-expanded="false">
									<div class="collapsed">
										<?php echo $sponsor->get_description(); 	?>
									</div>
								</div>
								<button class="show-more button--text fz-sm" data-toggle-text="Show Less" data-toggle="collapse" data-target="#<?= $sponsor->get_slug() . '__collapse'; ?>">
									Show More ...
								</button>
								<a href="<?= $sponsor->get_company_url(); ?>" class="button button--primary">Website</a>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

			</section>
		<?php
		endif;
		?>
	<?php
	endif; ?>
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