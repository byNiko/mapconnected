<div class="events-search__wrapper">
	<form role="search" method="get">
		<input type="search" placeholder="Search Events" name="s" value="">
		<input type="hidden" name="post_type" value="event">
		<?php //wp_nonce_field( 'name_of_my_action', 'name_of_nonce_field' ); 
		?>
		<button class="button button--primary button--inline-submit">submit</button>

	</form>
</div>