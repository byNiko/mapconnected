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
<main id="primary" class="site-main">
	<?php if (have_posts()) : ?>
		<header class="page-header">
			<div class="filter__prev-next-wrapper d-flex">
				<a href="?event-range=past"> &larr;Past </a>
			</div>
		</header><!-- .page-header -->
		<section class="EventFilter">

			<div class="filter-wrap d-flex justify--space-between align-center">
				<div class="filter__input-wrapper">
					<?php get_template_part('/template-parts/components/search-events'); ?>
				</div>
				<div class="filter__category-wrapper pillbox ">
					<?php
					$terms = get_terms(array(
						'taxonomy'   => 'event-type',
						'hide_empty' => true,
					));
					if ($terms) :
						foreach ($terms as $term) :
							$arr_params = array( 'event-type' => $term->slug );	
							$params = esc_url( add_query_arg( $arr_params ) );
							echo "<a class='pill' href='$params'>$term->name</a>";
						endforeach;
					endif;
					?>
				</div>
			</div>

		</section>
		<div class="event-archive--list">
			<?php
			while (have_posts()) : the_post();
				get_template_part('/template-parts/content', 'event-listing');
			endwhile;
			?>
		</div>
		<div class="pagination">
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

<?php
if (byniko_has_sidebar()) {
	get_sidebar();
};


get_footer();
