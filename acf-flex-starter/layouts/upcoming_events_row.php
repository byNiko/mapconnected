<?php
$dateNow = Byniko::future_expiration();
$query_args = array(
	'posts_per_page' => 2,
	'post_type' => 'event',
	'post_status' => 'publish',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'meta_key' => 'start_date__time',
	// 'orderby'        => 'rand',
	'meta_query' => array(
		array(
			'key' => 'start_date__time',
			'compare' => '>',
			'value' => $dateNow,
			'type' => 'DATETIME',
		)
	)
);

$q = new WP_Query($query_args);
$next_summit = get_posts([
	'post_type' => 'summit',
	'posts_per_page' => 1,
	'orderby' => 'meta_value',
	'status' => 'publish',
	'order' => 'DESC',
	'meta_key' => 'dates_summit_start_date',
	'meta_query' => [
		[
			'key' => 'dates_summit_start_date',
			'compare' => '>',
			'value' => $dateNow,
			'type' => 'DATETIME',
		]
	]
]);

if ($next_summit):
	$annual_summit = array(
		'image' => get_field('landing_section_summit_logo', $next_summit[0]->ID),
		'title' => get_field('landing_section_summit_theme_title', $next_summit[0]->ID),
		'subtitle' => get_field('landing_text_summit_theme_subtitle', $next_summit[0]->ID),
	);
	$image = $annual_summit['image'] ? wp_get_attachment_image($annual_summit['image'], 'medium', false, ['style' => 'width:100%']) : false;
	$annual_content =  $image ? $image : "<h2>" . ($annual_summit['title'] ?: "Annual Summit") . "</h2>"; // image or tex
endif;

	if ($q->have_posts()) :


?>
	<div class="flexible-content-wrap">
		<div class="container--wide">
			<header class="text-center">
				<h2 class="h2">Upcoming Events</h2>
			</header>
			<div class="flex-row event-cards__row">
				<?php
				if ($next_summit):	?>
					<div class="event-card__wrapper">
						<div class="event__top-bar">
							<div class="event__category">
								<div class="pill theme--medium-2">Annual Summit</div>
							</div>

						</div>
						<div class="card event-card theme--dark-1">
							<div class="event-card__main">
								<?php echo $annual_content; ?>
							</div>
							<div class="event-card__link">
								<a class="button button--accent" href="/annual-summit">More Info</a>
							</div>
						</div>
					</div>
				<?php endif; ?>
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
					<a class="button button--text  fw-bold" href="/events">View All Events</a>
					</h2>
					</header>
		</div>
	</div>
<?php
endif;
wp_reset_query();
