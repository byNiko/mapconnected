</div> <!-- <div class="site-content"> -->

<footer id="colophon" class="site-footer ">
<?php get_template_part('/template-parts/components/footer-gallery'); ?>
	<div id="inner-footer" class="inner-footer container">
		<div class="flex-row">
			<div class="footer-col">
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
				<?php
				wp_nav_menu(
					array(
						'theme_location' 	=> 'menu-3',
						'menu_class' 		=> 'footer-nav--menu menu',
						'menu_id'        	=> 'menu-3',
						'container'			=> 'nav',
						'container_class'	=> 'footer-nav--container',
						'container_id'		=> 'footer-nav--container',
						'item_spacing'		=> 'discard'
					)
				);
				?>
			</div>
			<div class="footer-col">
				<?php
				wp_nav_menu(
					array(
						'theme_location' 	=> 'menu-4',
						'menu_class' 		=> 'footer-nav--menu menu',
						'menu_id'        	=> 'menu-4',
						'container'			=> 'nav',
						'container_class'	=> 'footer-nav--container',
						'container_id'		=> 'footer-nav--container',
						'item_spacing'		=> 'discard'
					)
				);
				?>
			</div>
			<div class="footer-col">
				<?php
				wp_nav_menu(
					array(
						'theme_location' 	=> 'menu-5',
						'menu_class' 		=> 'footer-nav--menu menu',
						'menu_id'        	=> 'menu-5',
						'container'			=> 'nav',
						'container_class'	=> 'footer-nav--container',
						'container_id'		=> 'footer-nav--container',
						'item_spacing'		=> 'discard'
					)
				);
				?>
			</div>
			<div class="footer-col-wide">
				<div class="h3 fw-semi-bold">Stay Connected!</div>
				<?php echo FrmFormsController::get_form_shortcode(array('id' => 3)); ?>
			</div>
		</div><!-- .site-info -->
	</div>

	<?php wp_footer(); ?>
</footer><!-- #colophon -->

</div><!-- #page -->
<?php //get_template_part('/template-parts/components/modal-form__contact'); ?>
<?php get_template_part('/template-parts/components/modal--form--summit-brochure'); ?>
<?php echo (new Byniko())->get_video_modal_html(); ?>


</body>

</html>