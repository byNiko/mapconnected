</div> <!-- <div class="site-content"> -->


<footer id="colophon" class="site-footer ">

	<div id="inner-footer" class="inner-footer container">
		<div class="flex-row no-wrap" style="flex-wrap:nowrap">
			<div class="first-footer-col">
				<div class="site-info">
					<div class="footer-branding">
						<?php
						$homeUrl = get_home_url();

						if ($alt_logo_url = get_theme_mod('secondary_logo')) : ?>
							<a href='<?= $homeUrl; ?>'>
								<img src='<?= $alt_logo_url; ?>' alt='MAPconnected Logo' class='site-footer-logo'>
								<p class='site-description'>
									<?= get_bloginfo('description', 'display'); ?>
								</p>
							</a>
						<?php endif; ?>
					</div> <!-- .footer-branding -->
				</div>
			</div>
			<div class="footer-col">
				<div class="footer-col-widgets">
					<?php dynamic_sidebar('footer-1'); ?>
				</div>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->

<?php get_template_part('/template-parts/components/modal--form--summit-brochure'); ?>
<?php echo (new Byniko())->get_video_modal_html(); ?>
<?php wp_footer(); ?>
</div><!-- #page -->
<?php //get_template_part('/template-parts/components/modal-form__contact'); 
?>



</body>

</html>