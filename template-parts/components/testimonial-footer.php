<?php
if ($t = $args['testimonial']) :

	$vm = $t->video_url ? new VideoModal($t->video_url, $t->get_name()) : null;
?>
	<footer class="testimonial-card__footer">
		<?php if ($video_url = $t->get_video_url()) : ?>
		<?php endif; ?>
		<div class="testimonial-card__footer-content">

			<?php $t->the_vertical_image(); ?>

			<?php if ($name = $t->get_name()): ?>
				<cite class="testimonial__name">
					<?= $name  ?>
				</cite>
			<?php endif; ?>

		</div>
		<div class="testimonial-card__footer-content">
			<cite class="testimonial-card__title"> <?= $t->get_title();  ?></cite>
			<cite class="testimonial-card__company"> <?= $t->get_company();  ?></cite>
			<cite class="testimonial-card__logo-wrapper"> <?= $t->get_company_logo_image();   ?></cite>
			<?php echo $vm ? $vm->get_video_modal_trigger('Video Testimonial', 'innerclass') : ''; ?>
		</div>
	</footer>
<?php endif; ?>