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
	<section class="hero-section mb-4">
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
		$partner_group = get_field('partner_group');
		// print_r($partner_group);
		if ($partner_group[0] && $partner_group[0]['sponsors_group']) :
			$sponsors = $partner_group[0]['sponsors_group'];
		?>
			<section id="marketplace_sponsor_logos_wrap ">
				<div class="container--very-narrow theme--medium-1 py-1">
					<header class="my-1">
						<h4 class="text-center"><?= $partner_group[0]['label'] ?? "Marketplace Sponsors "; ?></h4>
					</header>
					<?php

					get_template_part(
						'/acf-flex-starter/layouts/sponsor_logos_slider',
						null,
						array(
							'sponsors' => $sponsors,
							'slider_options' => ['perPage' => "12"]
						)
					);
					?>
					<div class="flex-row justify--center mt-1 ">
						<a href="#marketplace-1" class="text-link fw-semi-bold text-uppercase">Show me the marketplace</a>
					</div>
				</div>
			</section>
		<?php
		endif;
		?>
		<div class="leader-content py-1">
			<div class="container--single-column fz-md">
				<?php
				while (have_posts()) :
					the_post();

					get_template_part('template-parts/content', 'page');
				endwhile; // End of the loop.
				?>
				<div class="two-button-cta">
					<div class="flex-row  justify--center">
						<div class="flex-column">
							<span class="fz-sm fw-semi-bold">Have a Project or Training need</span>
							<a href="/about-us#contact-form" class="button button--primary has-shadow-1 ">Contact Us</a>
						</div>
						<div class="flex-column">
							<div class="fz-sm fw-semi-bold text-center">Take me to the MARKETPLACE</div>
							<a href="#marketplace-1" class="button button--secondary has-shadow-1">MyWarrantyNetwork Sponsors</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php

	$args = array(
		'post_type' => ['event', 'post'],
		'status' => 'publish',
		'posts_per_page' => 12,
		'orderby'        => 'menu_order',
		'order' => 'ASC',
		'tax_query' => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'category',
				'field' => 'name',
				'terms' => 'news'
			),
			array(
				'taxonomy' => 'event-type',
				'field' => 'name',
				'terms' => get_terms('event-type')[0]->name
			)
		)
	);
	$q = new WP_Query($args);
	if ($q->have_posts()) :
	?>
		<section class="blog_and_news__wrapper theme--medium-1 py-4">
			<header class="text-center">
				<h2 class="fz-display">News and Events</h2>
			</header>
			<div class="container-fluid">
				<div class="grid __4x justify--center">

					<?php while ($q->have_posts()) : $q->the_post(); ?>
						<?php
						$event = new Event($post);
						$type = get_post_type($post);
						?>

						<div class="card-item">
							<div class="pillbox">
								<div class="pill pill--post-type__<?= $type; ?>"><?= $type; ?></div>
							</div>
							<h3 class="h3 event--title mt-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="event--description"><?= wp_trim_words($event->get_description(), 15); ?> </div>
						</div>
				<?php
					endwhile;
				endif;
				wp_reset_query();
				?>
				</div>
			</div>
			<footer class="text-center pt-4">
				<a href="/news" class="button button--text fz-lg">View all News</a>
			</footer>
		</section>
		<?php
		if ($partner_group) :
			$count = 0;
			foreach ($partner_group as $partner) :
				$count++;
		?>
				<section id="marketplace-<?= $count; ?>" class="py-4">
					<div class="container--narrow">
						<header class="text-center">
							<h2 class="h2"><?= $partner['label'] ?? "Partner"; ?> </h2>
						</header>
						<div class="grid __2x justify--center">
							<?php foreach ($partner['sponsors_group'] as $sp) : ?>
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
									<?php if ($sponsor->downloadable_file): ?>
										<a download href="<?= $sponsor->downloadable_file['url']; ?>" class="button button--outline">Download Sponsor Prospectus</a>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>

				</section>
		<?php
			endforeach;
		endif;
		?>



</main><!-- #main -->
<?php //get_sidebar('sidebar'); 
?>
<?php get_footer(); ?>