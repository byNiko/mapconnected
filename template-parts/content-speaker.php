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
	<header class="entry-header">
		<?php
		if (function_exists('yoast_breadcrumb')) {
			//yoast_breadcrumb('<div id="breadcrumbs" class="breadcrumbs">', '</div>');
		}
		?>
		<?php $headshot = $speaker->get_headshot1($speaker); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="flex-row column-gap--large">
			<div class="speaker__headshot flex-30">
				<?php
				echo !empty($headshot['id'])
					? wp_get_attachment_image($headshot['id'], 'full')
					: "need headshot fallback";
				?>
			</div>
			<div class="speaker__info">
				<?php the_title('<h1 class="entry-title h1 mb-0">', '</h1>'); ?>

				<div class="speaker__meta fz-sm">
					<div><?= $speaker->get_title(); ?></div>
					<div><?= $speaker->get_company(); ?></div>
					<div class="speaker__logo">
					<?php 
					$logo = $speaker->get_logo($speaker);
					echo !empty($logo['id'])
					? wp_get_attachment_image($logo['id'], 'sm')
					: "need logo fallback";
					?>
				</div>
				</div>

				<section class="speaker__bio">
					<?= $speaker->get_bio(); ?>
				</section>
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