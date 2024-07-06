<?php 
if ($t = $args['testimonial']) : 
	$vm = $t->video_url ? new VideoModal($t->video_url, $t->get_name()) : null;
	?>
	<footer class="testimonial-card__footer">
		<?php if ($video_url = $t->get_video_url()) : ?>
			<div class="testimonials-card__image-wrapper">
				<?php
				if ($vertImage = $t->get_vertical_image())
					//echo wp_get_attachment_image($vertImage['id'], 'portrait');
				?>
			</div>
		<?php endif; ?>
		<div class="flex-column ml-a">
			<div class="flex-column">
			<?php if($name = $t->get_name()):?>
			<cite class="testimonial__name"> <?= $name  ?></cite>
			<?php endif; ?>
			<cite class="testimonial-card__title"> <?= $t->get_title();  ?></cite>
			<cite class="testimonial-card__company"> <?= $t->get_company();  ?></cite>
			<cite class="testimonial-card__logo-wrapper"> <?= $t->get_company_logo_image();   ?></cite>
			<?php echo $vm ? $vm->get_video_modal_trigger('Video Testimonial', 'innerclass') : ''; ?>
			</div>
		</div>
	</footer>
<?php endif; ?>