<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package byniko
 */
load_class('Speaker');
load_class('Sponsor');
load_class('Event');
$event = new Event($post);
$times = $event->get_time();
$start_datetime = $times['start'];
$end_datetime = $times['end'];
$startDay = $start_datetime ? $start_datetime->format('D') : null;
$startDate = $start_datetime ? $start_datetime->format('dS') : null;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
<header class="entry-header">
		<?php
		if (function_exists('yoast_breadcrumb')) {
			yoast_breadcrumb('<div id="breadcrumbs" class="breadcrumbs">', '</div>');
		}
		?>
		<?php the_title('<h1 class="entry-title h1">', '</h1>'); ?>
	</header><!-- .entry-header -->


	<div class="entry-content">
	<?php byniko_post_thumbnail(); ?>
		<div class="event--description">
			<div class="fz-md">
			<?= $event->get_description(); ?>
			</div>
			
		</div>
		
		<?php
		$speakers = $event->get_speakers();
		
		if (!empty($speakers)) :
			$plural = count($speakers) > 1;
		?>
			<section class="event--speakers">
				<h5 class="h5">Your Host<?= $plural ?  "s" : "";?></h5>
				<div class="event-speakers--items flex-row __4x">
					<?php
					foreach ($speakers as $speaker) :
						$speaker = new Speaker($speaker);
						$speaker->the_speaker_card(true);?>
					<?php 	endforeach; 	?>
				</div>
			</section>
		<?php endif; ?>
		<?php
		$sponsors = $event->get_sponsors();
		
		if (!empty($sponsors)) :
			$plural = count($sponsors) > 1;
		?>
			<section class="event--sponsors-wrap ">
			<h5 class="h5">Sponsor<?= $plural ?  "s" : "";?></h5>
			<div class="flex-row align-center justify--space-evenly px-1 py-1 theme--medium-1 border-radius-1">
					<?php
					foreach ($sponsors as $sponsor) :
						$sponsor = new Sponsor($sponsor);
					?>
						<div class="event-sponsor ">
							<a href="<?= $sponsor->get_sponsor_page_link(); ?>" class="d-flex flex-column">
								<div class="event-sponsor__logo">
									<img src="<?= $sponsor->get_logo_image_src(); ?>" alt="<?= $sponsor->get_name();?> Logo">
								</div>
							</a>
						</div>
					<?php 	endforeach; ?>
					</div>
			</section>
		<?php endif; ?>
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'byniko'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if (get_edit_post_link()) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Edit <span class="screen-reader-text">%s</span>', 'byniko'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->