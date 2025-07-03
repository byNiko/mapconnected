<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package byniko
 */
get_header();
?>
<div class="container--narrow">
	<main id="primary" class="site-main">
		<?php if (have_posts()) : ?>
			<header class="page-header">

			</header><!-- .page-header -->
			<section class="EventFilter mt-1">

				<div class="filter-wrap d-flex justify--space-between align-center">
					<div class="filter__prev-next-wrapper d-flex">
						<div class="pagination">
							<?php
							// $archive_page_count =  (new Byniko())->get_total_number_archive_pages();
							$arr_params = array(
								'event-range' => 'past',
								// 'paged' => $archive_page_count
							);
							$params = esc_url(add_query_arg($arr_params));
							$past = get_query_var('event-range') === "past";
							?>
							<?php if (!$past): ?>
								<a href="<?= $params; ?>"> &larr;Past </a>
							<?php else: ?>
								<?php echo (new Byniko())->reverse_pagination(); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="filter__input-wrapper">
						<?php get_template_part('/template-parts/components/search-events'); ?>
					</div>
					<div class="filter__category-wrapper pillbox ">
						<?php
						$terms = get_terms(array(
							'taxonomy'   => 'event-type',
							'hide_empty' => true
						));
						if ($terms) :
							foreach ($terms as $term) :
								$arr_params = array(
									'event-type' => $term->slug,
									'event-range' => 'all'
								);
								$params = esc_url(add_query_arg($arr_params));
								echo "<a class='pill' href='$params'>$term->name</a>";
							endforeach;
						endif;
						?>
					</div>
				</div>

			</section>
			<div class="event-archive--list">
				<?php
				$posts = $wp_query->posts;
				// reverse posts if we're looking at past events
				$past = get_query_var('event-range') === "past";

				if ($past)
					$posts = array_reverse($wp_query->posts);

				while (have_posts($posts)) : the_post($posts);
					get_template_part('/template-parts/content', 'event-listing');
				endwhile;
				?>
			</div>
			<div class="pagination mt-1">
				<?php
				(new Byniko())->reverse_pagination();
				?>
			</div>
		<?php
		else :
			get_template_part('template-parts/content', 'no-events');
		endif;
		?>

	</main><!-- #main -->
</div>
<?php
get_footer();
