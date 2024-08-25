<?php
if ($notification = get_field('notification_bar', 'options')) :
	$cta = $notification['cta'];
	$link = $notification['link'];
	$is_active = $notification['is_active'];
	// check if we're on the page we're being linked to 
	$url_match = (new Byniko())->url_match($link['url']);
	if (!$url_match && $is_active) :
?>
		<div class="top-notification-bar theme--bright-1">
			<div class="container text-center">
				<a href="<?= $link['url']; ?>" class="flex-row justify--center align-center">
					<div class="text-center fw-bold "><?= $cta; ?></div>
					<button class="button button--accent "><?= $link['title']; ?> </button>
				</a>
			</div>
		</div>
<?php
	endif;
endif;
