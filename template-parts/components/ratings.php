<?php
if ($args['summit-data']->get_statistics_section_data('ratings'))
	$ratings = $args['summit-data']->get_statistics_section_data('ratings');
?>
<div class="ratings-group">
	<?php
	foreach ($ratings as $r) :
		$title = $r['title'];
		$max = $r['max_value'];
		$measured = $r['measured_value'];
	?>
		<div class="rating-group">
			<div class="rating-title"><?= $title; ?> - <span class="measurements"><?= $measured; ?> / <?= $max; ?></span></div>
			<div class="rating-container">
				<div class="rating-value" data-measured-value='<?= $measured; ?> ' data-max-value="<?= $max; ?>"></div>
			</div>
		</div>
	<?php
	endforeach;
	?>

</div>

<style>
	.ratings-group {
		container-type: inline-size;
		--bar-bg: #ddd;
		--bar-value-1: orange;
		--bar-value-2: gold;
		--border-radius: 1em;
		display: flex;
		flex-direction: column;
		justify-content: center;
		gap: 0.1em;
	}

	.rating-title {
		font-size: .8em;
		margin-bottom: .25em;
	}

	.rating-container,
	.rating-value {
		border-top-right-radius: var(--border-radius);
		border-bottom-right-radius: var(--border-radius);
		border: 1px solid #ddd;
	}

	.rating-container {
		background: var(--bar-bg);
		width: 100%;
		height: 30px;
		position: relative;
		overflow: hidden;
	}

	.rating-group {
		margin-top: 0.5em;
	}

	.rating-value {
		position: absolute;
		bottom: 12%;
		left: 0;
		right: 0;
		top: 2%;
		width: 50%;
		background-image: linear-gradient(to bottom right, var(--bar-value-1) 0%, var(--bar-value-2));
		border-bottom-right-radius: 1rem;
		border-top-right-radius: 1rem;
		box-shadow: 3px 3px 5px #999;

	}
</style>

<script>
	(() => {

		const ratingValues = document.querySelectorAll('[data-measured-value]')
		ratingValues.forEach(el => {
			const v = el.dataset.measuredValue;
			const m = el.dataset.maxValue;
			el.setAttribute('style', `width:${(v/m) * 100}%`);
		})
	})()
</script>