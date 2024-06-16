<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package byniko
 */
load_class('Speaker');
load_class('Event');
$speaker = new Speaker($post);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if (function_exists('yoast_breadcrumb')) {
		//yoast_breadcrumb('<div id="breadcrumbs" class="breadcrumbs">', '</div>');
	}
	?>
	<div class="entry-content ">
		<div class="d-flex column-gap--large">
			<aside class="flex-30 ">
				<?= $speaker->the_speaker_card(); ?>
			</aside>

			<div class="speaker__info">
				<header class="entry-header">
					<?php the_title('<h1 class="entry-title h1">', '</h1>'); ?>
				</header><!-- .entry-header -->
				<div class="speaker__bio">
					<?= $speaker->get_bio(); ?>
				</div>
				<div class="speaker__events-list">
					<h4 class="h4">Associated Events</h4>
					<?php $speaker->the_events_list(); ?>
				</div>
			</div>
		</div>

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