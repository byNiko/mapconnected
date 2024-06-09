</div> <!-- <div class="site-content"> -->
<footer id="colophon" class="site-footer ">
	<div id="inner-footer" class="inner-footer container">
		<div class="flex-row">
			<div class="footer-col">
				<div class="site-info">
					<div class="footer-branding">
						<?php
						$homeUrl = get_home_url();
						$byniko_description = get_bloginfo('description', 'display');
						if ($alt_logo_url = get_theme_mod('secondary_logo')) : ?>
							<a href='<?= $homeUrl; ?>'>
								<img src='<?= $alt_logo_url;?>' alt='MAPconnected Logo' class='site-footer-logo'>
								<p class='site-description'>
									<?= $byniko_description; ?>
								</p>
							</a>
						<?php endif; ?>
					</div> <!-- .footer-branding -->
					<?php


					if ($byniko_description) :
					?>

					<?php endif; ?>
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
			<div class="footer-col">
				<div class="h3 fw-semi-bold">Stay Connected!</div>
			<?php echo FrmFormsController::get_form_shortcode( array( 'id' => 3 ) ); ?>
			</div>
		</div><!-- .site-info -->
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>