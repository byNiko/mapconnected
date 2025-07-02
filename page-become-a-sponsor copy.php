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
	<?php the_content(); ?>
	<?php if ($landing_section = get_field('landing_section')) : ?>
		<section class="container--very-narrow">
			<header class="text-center">
				<h1 class="fz-display">Become a Sponsor!</h1>
				<h2 class="h2"><?= $landing_section['subtitle']; ?></h2>
			</header>
			<div class="content mt-1">
				<p class="fz-md"><?= $landing_section['short_leader_copy']; ?></p>
			</div>
		</section>
	<?php endif; ?>
	<?php
	$sponsors = get_field('sponsors_group');
	if ($sponsors) :
		$count = count($sponsors);
		$group1 = array_slice($sponsors, 0, intval(ceil($count / 2)));
		$group2 = array_slice($sponsors, intval(floor($count / 2)));

	?>
		<section id="curent_prev_sponsors" class=" p-relative mt-4">
			<header>
				<h3 class="h3 text-center">Snapshot of Current and Previous Sponsors</h2>
			</header>
			<div class="theme--medium-1">
				<div class=" pt-1">
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
				<div class=" py-1 ">
					<?php
					get_template_part(
						'/acf-flex-starter/layouts/sponsor_logos_slider',
						null,
						array(
							'sponsors' => $group2,
							'slider_options' => ['perPage' => "8", 'autoScroll' => ['speed' => '-.25']]
						)
					);
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	if ($list_of_benefits = get_field('list_of_benefits')) :
		if ($list = $list_of_benefits['definition_list']) :
	?>
			<section id="elevate-brand" class="theme--false">

				<div class="container--very-narrow">
					<h2 class="h2 text-center">Elevate Your Brand</h2>
					<div class="flex-row ">
						<dl class="columns__2">
							<?php foreach ($list as $item) : ?>
								<dt><?= $item['term']; ?></dt>
								<dd><?= $item['definition']; ?></dd>
							<?php endforeach; ?>
						</dl>
					</div>
				</div>
			</section>
	<?php endif;
	endif; ?>

	<?php
	if (have_rows('sponsorship_opportunities')) : while (have_rows('sponsorship_opportunities')) : the_row();
			if ($spships = get_sub_field('sponsorship_option')) : ?>
				<section id="sponsorship-opportunities" class="theme--medium-1">
					<div class="container--narrow">
						<header>
							<h2 class="h2 text-center">Two Ways to Sponsor!</h2>
						</header>
						<div class="flex-row justify--center">
							<?php foreach ($spships as $spship) : ?>
								<a href="#<?= sanitize_title($spship['section_title']); ?>" class="button button--icon button--lg"><?= $spship['section_title']; ?></a>
							<?php endforeach; ?>
						</div>
					</div>
				</section>
	<?php
			endif;
		endwhile;
	endif;
	?>
	<?php
	$count = 0;
	if (have_rows('sponsorship_opportunities')) : while (have_rows('sponsorship_opportunities')) : the_row();
			if (have_rows('sponsorship_option')) : while (have_rows('sponsorship_option')) : the_row();
					$count++;
					$theme = $count % 2 === 0 ? "theme--medium-2" : "theme--false"
	?>
					<section id="<?= sanitize_title(get_sub_field('section_title')); ?>" class="<?= $theme; ?>">
						<header class="container--very-narrow">
							<h2 class="h2 text-center flex-column">
								<?= wp_get_attachment_image(get_sub_field('section_image'), 'full'); ?>
								<?= get_sub_field('section_subtitle'); ?>
							</h2>
							<div class="content">
								<p><?php the_sub_field('description'); ?></p>
							</div>
						</header>


						<?php if (get_sub_field('icon_grid')) : ?>
							<section class="icon-grid__wrapper theme--false">
								<h2 class="h2 text-center"><?php the_sub_field('icons_title'); ?> </h2>
								<div class="container--very-narrow theme--medium-1 py-1 border-radius-2">
									<?php get_template_part('/acf-flex-starter/layouts/icon_grid'); ?>
								</div>
							</section>
						<?php endif; ?>


						<section class="theme--false">
							<div class="container--narrow">
								<div class="flex-row __2x">
									<div class="col flex-column justify--center">
										<?= get_sub_field('footer_text'); ?>
										<?= get_acf_link(get_sub_field('footer_link'), 'button button--primary'); ?>
									</div>
									<div class="col d-flex">
										<?= wp_get_attachment_image(get_sub_field('footer_single_image'), 'full'); ?>
									</div>
								</div>
							</div>
						</section>
					</section>

	<?php endwhile;
			endif;
		endwhile;
	endif;
	?>
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
	<section id="sponsor-form" class="theme--dark-gradient-1 last-section pb-4">
		<div class="container--narrow justify--center align-center">
			<header class="text-center pb-4">
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
</main><!-- #main -->
<?php get_footer();
