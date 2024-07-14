<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package byniko
 */

get_header();
?>
<div class="container--wide">
	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header text-center">
				<h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'byniko'); ?></h1>
				<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'byniko'); ?></p>
				<?php
				get_search_form();
				?>
			</header><!-- .page-header -->

			<div class="page-content">
				<div class="container--single-column">
					<div class="inner-container">
					<?php
				the_widget('WP_Widget_Recent_Posts');

				?>
					</div>
					<div class="inner-container d-none">
						<div class="404-content-container text-center">
							<div class="widget widget_categories">
								<h2 class="widget-title"><?php esc_html_e('Most Used Categories', 'byniko'); ?></h2>
								<ul class='no-bullet grid flex-wrap'>
									<?php
									wp_list_categories(
										array(
											'orderby'    => 'count',
											'order'      => 'DESC',
											'show_count' => 1,
											'title_li'   => '',
											'number'     => 10,
										)
									);
									?>
								</ul>
							</div><!-- .widget -->
						</div>
					</div>

					<div class="inner-container d-none">
						<div class="404-content-container text-center">
							<?php
							the_widget('WP_Widget_Tag_Cloud');
							?>
						</div>
					</div>
				</div>

				



			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->
</div>
<?php
get_footer();
