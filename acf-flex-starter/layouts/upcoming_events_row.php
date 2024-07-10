<?php

$query_args = array(
	'posts_per_page' => 2,
	'post_type' => 'event',
	'post_status' => 'publish',
	// 'orderby'        => 'rand',
	// 'tax_query' => array(
	// 	array()
	// ),
);

$q = new WP_Query($query_args);
if ($q->have_posts()) :

	$annual_summit = array(
		'image' => wp_get_attachment_image(get_sub_field('image'), 'medium'),
		'text' => get_sub_field('text'),
		'theme' => get_sub_field('theme'),
		'link' => get_acf_link(get_sub_field('link'), 'button button--primary')
	);
	$annual_content = $annual_summit[get_sub_field('card_content')]; // image or text

?>
	<div class="flexible-content-wrap">
		<div class="container--wide">
			<header class="text-center">
				<h2 class="h2">Upcoming Events</h2>
			</header>
			<div class="flex-row event-cards__row">
				<div class="event-card__wrapper">
					<div class="event__top-bar">
						<div class="event__category">
							<div class="pill theme--medium-2">Annual Summit</div>
						</div>

					</div>
					<div class="card event-card theme--light-3">
						<div class="event-card__main">
							<?= $annual_content; ?>
						</div>
						<div class="event-card__link">
							<?= $annual_summit['link']; ?>
						</div>
					</div>
				</div>
				<?php
				while ($q->have_posts()) : $q->the_post();
					$event = new Event($post);
					$pills = $event->get_event_tag_pills();
				?>
					<div class="event-card__wrapper">
						<div class="event__top-bar d-flex justify--space-between fz-sm">
							<div class="event__category"><?= $pills; ?> </div>
							<div class="event__date "><?= $event->get_time()['start_date']; ?> </div>
						</div>
						<div class="card event-card theme--dark">
							<div class="event-card__title fw-semi-bold">
								<?php the_title(); ?>
							</div>
							<div class="event-card__link">
								<a class="button button--secondary" href="<?php the_permalink(); ?>">More Info</a>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
			<footer class="text-center mt-1">
				<h3 class="h3">
					<a class="button button--text button--primary fz-lg fw-bold" href="/events">View All Events</a>
				</h2>
			</header>
		</div>
	</div>
<?php
endif;
wp_reset_query();
