<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">

		<?php echo byniko_get_theme_image('GeoPin_Outline.svg', array('class' => 'geopin_header')); ?>
		<?php get_template_part('/template-parts/components/notification-bar');?>
		<header id="masthead" class="site-header ">
			<div class="notification-bar">
				<div class="h2"></div>
			</div>
			<div class="container container--wide">
				<div class="flex-row top-row">
					<div class="site-branding">
						<?php
						if (has_custom_logo()) :
							the_custom_logo(); ?>
							<div class='site-description'>
								<?= get_bloginfo('description', 'display'); ?>
							</div>
						<?php
						else :
						?>
							<h1 class="site-title">
								<a href="<?= esc_url(home_url('/')); ?>" rel="home">
									<?php bloginfo('name'); ?>
								</a>
							</h1>
						<?php
						endif;
						$byniko_description = get_bloginfo('description', 'display');
						if ($byniko_description || is_customize_preview()) :
						?>
							<p class="site-description"><?= $byniko_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
														?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->
					<?php
					wp_nav_menu(
						array(
							'theme_location' 	=> 'menu-2',
							'menu_class' 		=> 'top-nav--menu menu',
							'menu_id'        	=> 'top-nav',
							'container'			=> 'nav',
							'container_class'	=> 'top-nav--container',
							'container_id'		=> 'top-nav--container',
							'item_spacing'		=> 'discard'
						)
					);
					?>
				</div>
			</div>
			<div class="primary-bar container-fluid">

				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-nav" aria-expanded="false"><?php esc_html_e('Primary Nav', 'byniko'); ?></button>

					<?php
					wp_nav_menu(
						array(
							'theme_location' 	=> 'menu-1',
							'menu_class' 		=> 'main-nav--menu menu',
							'menu_id'       	=> 'primary-nav',
							'container'			=> 'nav',
							'container_class'	=> 'main-nav--container',
							'container_id'		=> 'main-nav--container',
							'item_spacing'		=> 'discard'
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>
		</header><!-- #masthead -->
		<div class="site-content">