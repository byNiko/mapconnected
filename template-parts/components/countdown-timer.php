<?php
if ($deadline = $args['summit_start_date']) :
	$data = json_encode(array(
		'deadline' => $deadline
	));
	wp_enqueue_script('countdownTimer', get_template_directory_uri() . '/dist/countdownTimer.js', array(), false, true);
	wp_add_inline_script('countdownTimer', "countdownTimer = $data", 'before');
?>
	<div class="container--narrow py-4">
		<header class='text-center'>
			<h2 class='h2'><?= $args['countdown_title'] ?? 'Countdown Timer'; ?></h2>
		</header>
		<div class="text-center">
			<div id="clockdiv" class="clockdiv">
				<div>
					<span class="days"></span>
					<div class="smalltext">Days</div>
				</div>
				<div>
					<span class="hours"></span>
					<div class="smalltext">Hours</div>
				</div>
				<div>
					<span class="minutes"></span>
					<div class="smalltext">Minutes</div>
				</div>
				<div>
					<span class="seconds"></span>
					<div class="smalltext">Seconds</div>
				</div>
			</div>
		</div>

	</div>


<?php endif;
