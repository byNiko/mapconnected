<?php

$byniko = new Byniko();
$spships = new Sponsorships();
$s = new Summit($post);

get_header(); ?>


<main class="annual_summit">
	<section class="hero theme--dark-gradient-1 pb-4">
		<div class="secondary-nav__wrapper">
			<?php get_template_part('/template-parts/summit/summit', 'secondary-nav'); ?>
		</div>
		<?php get_template_part('/template-parts/summit/summit', 'landing-section', ['summit-data' => $s]); ?>
	</section>
	<?php
	if ($key_speakers = get_field('speakers_group')) :
		if (!$key_speakers['hide_key_speakers']) :
			$title = $key_speakers['key_speakers_title'] ?: "Key Speakers";
	?>
			<section id="key-speakers" class="key-speakers py-4">
				<div class="container--narrow">
					<header class="text-center">
						<h2 class="h2 fz-xxl"><?= $title; ?></h2>
					</header>
					<?php get_template_part('/template-parts/summit/summit', 'key-speakers', ['summit_post' => $post]); ?>
					<?php
					if (!$key_speakers['hide_all_speakers_button']):
					?>
						<footer class="text-center mt-1">
							<a href="#all-leadership" class="button button--tertiary">View All Speakers</a>
						</footer>
					<?php endif; ?>
				</div>
			</section>
	<?php endif;
	endif; ?>

	<section id="title-section" class="title-section py-4">
		<header class="text-center">
			<div class="fz-xxxl fw-extra-bold summit-title"><?= $s->theme_title; ?></div>
			<div class="summit-subtitle"><?= $s->theme_subtitle; ?></div>
		</header>
		<div class="container--narrow">
			<div class="flex-row __2x">
				<div class="col">
					<div class="text-block">
						<?= $s->theme_summit_text; ?>
					</div>
					<?php echo $s->getRegistrationLinksSection();	?>

				</div>
				<div class="col flex-column gap-1">
					<div class="video-container">
						<?= $s->get_promotional_video(); ?>
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
		get_template_part('/template-parts/summit/summit-participating-logos');
	endif;
	?>

	<?php if ($data = $s->getLongCopySectionData(0)) : ?>
		<section id="summary" class="py-4">
			<?php get_template_part('/template-parts/summit/summit', 'long-copy', $data); ?>
		</section>
	<?php endif; ?>

	<?php if ($highlights = $s->getAgendaHighlights()) : ?>
		<section id="agenda_highlights" class="py-4">
			<div class="container--narrow">
				<div class="flex-column gap-1">
					<h2 class="h2 text-center">Agenda Highlights</h3>
						<div class="content flex-row">
							<div class="col">
								<?= $highlights ?>
							</div>
							<div class="col">
								<?php get_template_part(
									'/template-parts/components/ratings',
									null,
									['summit-data' => $s]
								); ?>
							</div>
						</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

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
			<section id="single-testimonial" class="single-testimonial py-4">
				<div class="container--very-narrow">
					<?= $t->get_single_testimonial_html(); ?>
				</div>
			</section>
	<?php
		endwhile;
	endif;
	wp_reset_query();
	?>

	<section id="agenda" class="scroll-padding--lg py-4">
		<div class="container--very-narrow">
			<div class="flex-column">
				<h2 class="h2 text-center"><?= $s->get_agenda_section_data('main_title'); ?></h2>
				<div class="text-content">
					<p><?= $s->get_agenda_section_data('subtitle'); ?></p>
				</div>
				<footer class="text-center mt-1">
					<?php
					$button_action = 'data-micromodal-trigger="modal-summit-brochure" ';
					if ($s->isAgendaDownloadAvailable()):
						$button_action = 'target="_blank" href="' . $s->getAgendaDownloadLink() . '" ';
					endif;
					?>
					<a <?= $button_action; ?> class="button button--outline ">Get the Full Agenda</a>
				</footer>
			</div>
		</div>
		<div class="container mt-4">
			<?php get_template_part('/template-parts/summit/daily-agendas', null, ['summit_post' => $post]); ?>
		</div>
	</section>
	

	<?php if ($speakers_group = get_field('speakers_group')) :?>
	<section id="all-leadership" class="all-leadership py-4">
		<?php get_template_part('/template-parts/summit/summit-all-speakers' );?>
	</section>
	<?php endif;  ?>

	<div class="container--narrow py-4">
		<div id="who-attends">
			<?php
			$data = $s->getLongCopySectionData(1);
			get_template_part('/template-parts/summit/summit', 'long-copy', $data);
			?>
		</div>
	</div>

	<section id="must-attend" class="theme--dark-gradient-1">
		<div class="container--very-narrow">
			<header class="text-center ">
				<h2 class="h2 ">Why is Service and Warranty Lifecycle Summit a Must-Attend?</h2>
				<div class="subtitle">MAPconnected's interactive engagement and networking opportunities</div>
			</header>
		</div>
		<div class="container--narrow">
			<div class="flex-row  mt-1">
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
		<section id="brochure-download" class="py-4">
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
			$cta = get_acf_link(get_sub_field('become_a_sponsor_cta'), 'button button--primary button--outline button--wide');
			if (have_rows('sponsorship_repeater')) :
				while (have_rows('sponsorship_repeater')) :
					the_row();
					if (!get_sub_field('hide')) :;
	?>
						<section id="sponsorships">
							<header class="text-center">
								<h2 class="h2"><?php the_sub_field('section_title'); ?></h2>
								<div class="text-center">
									<?= $cta; ?>
								</div>
							</header>
							<div class="theme--light-2 sponsorship-levels py-2 mt-1">
								<div class="container">
									<?php get_template_part('/template-parts/summit/sponsorship-levels'); ?>
								</div>
							</div>
						</section>
	<?php
					endif;
				endwhile;
			endif;
		endwhile;
	endif;
	?>
	<?php
	if (have_rows('icon_section')) :
		while (have_rows('icon_section')) :
			the_row();
			get_template_part('/template-parts/summit/summit', 'icon-section', $data);
		endwhile;
	endif;

	?>
	<?php
	if ($s->get_statistics_section_data('show_countdown_timer'))
		$data = $s->get_statistics_section_data();
	get_template_part('/template-parts/components/countdown-timer', null, $data);
	?>
	<div class="container--narrow py-4">
		<?php echo $s->getRegistrationLinksSection(); ?>
	</div>
	<?php

	if ($travel = get_field('travel_group', $post)) :
		get_template_part('/template-parts/summit/travel', null,  ['summit_post' => $post]);
	endif;
	?>

</main>


<?php
get_footer();
wp_reset_postdata();
