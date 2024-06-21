<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package byniko
 */

get_header();
global $wp_query;
?>


<main id="primary" class="site-main">fggg
	<?php if (have_posts()) : ?>
			<header class="page-header">
			</header><!-- .page-header -->
		<section class="EventFilter">

			<div class="filter-wrap d-flex justify--space-between align-center">
				<div class="filter__input-wrapper">
					<input type="text" placeholder="Search">
				</div>
				<div class="filter__category-wrapper d-flex ">
					<span class="pill pill--md">category 1</span>
					<span class="pill pill--md">category 2</span>
					<span class="pill pill--md">category 3</span>
				</div>
				<div class="filter__prev-next-wrapper d-flex">
					<span class="past">&larr;Past </span>
					<span class="next">Next &rarr;</span>
				</div>

			</div>

		</section>
		<div class="event-archive--list">
			<?php
			while (have_posts()) : the_post();
				$event = new Event($post);
				$times = $event->get_time();
				$start_datetime = $times['start'];
				$end_datetime = $times['end'];
				$startDay = $start_datetime ? $start_datetime->format('D') : null;
				$startDate = $start_datetime ? $start_datetime->format('dS') : null;
			?>
				<div class="event-archive-item event d-flex">
					<div class="event-archive-item--meta-date text-center">
						<div class="fz-sm"><?= $startDay; ?></div>
							<div class="fz-md fw-semi-bold"><?= $startDate; ?></div>
					</div>
					<div class="event-item--info">
							<header class="event--header ">
								<div class="event--start-time fz-sm">

									<?php
									echo !empty($start_datetime) ? $start_datetime->format('F d, g:iA') : "";
									echo !empty($end_datetime) ? $end_datetime->format(' - g:iA') : '';
									?>
								</div>
								<div class="event--categories pillbox">
								<?= $event->get_event_tag_pills();?>
								</div>
							</header>
							<h3 class="h3 event--title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="event--description"><?= wp_trim_words($event->get_description(), 55); ?> </div>
						</div>
						<aside class="event-archive-item--sidebar">
							<div class="event-archive-item--buttons d-flex flex-column align--center">
								<? 
								$disabled = $event->is_past()? "disabled" : '';
								echo get_acf_link($event->get_reservation_link(), "$disabled has-shadow-1 event-archive-item--button button button--primary"); 	
								?>
								<a class="has-shadow-1 button button--secondary button--outline event-archive-item--button" href="<?php the_permalink(); ?>"> More Info </a>
							</div>
						</aside>
			
				</div>
		<?php
			endwhile;
			the_posts_navigation();
		else :
			get_template_part('template-parts/content', 'none');
		endif;
		?>
		</div>
</main><!-- #main -->

<?php
if (byniko_has_sidebar()) {
	//get_sidebar();
};
get_footer();
