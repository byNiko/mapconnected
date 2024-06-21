<h1>Countdown Clock</h1>
<div id="clockdiv">
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




<style>
	#clockdiv {
		font-family: sans-serif;
		color: #fff;
		display: inline-block;
		font-weight: 100;
		text-align: center;
		font-size: 30px;
	}

	#clockdiv>div {
		padding: 10px;
		border-radius: 3px;
		background: #00BF96;
		display: inline-block;
	}

	#clockdiv div>span {
		padding: 15px;
		border-radius: 3px;
		background: #00816A;
		display: inline-block;
	}

	.smalltext {
		padding-top: 5px;
		font-size: 16px;
	}
</style>

<script>
	function getTimeRemaining(endtime) {
		const total = Date.parse(endtime) - Date.parse(new Date());
		const seconds = Math.floor((total / 1000) % 60);
		const minutes = Math.floor((total / 1000 / 60) % 60);
		const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
		const days = Math.floor(total / (1000 * 60 * 60 * 24));

		return {
			total,
			days,
			hours,
			minutes,
			seconds
		};
	}

	function initializeClock(id, endtime) {
		const clock = document.getElementById(id);
		const daysSpan = clock.querySelector('.days');
		const hoursSpan = clock.querySelector('.hours');
		const minutesSpan = clock.querySelector('.minutes');
		const secondsSpan = clock.querySelector('.seconds');

		function updateClock() {
			const t = getTimeRemaining(endtime);

			daysSpan.innerHTML = t.days;
			hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
			minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
			secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

			if (t.total <= 0) {
				clearInterval(timeinterval);
			}
		}

		updateClock();
		const timeinterval = setInterval(updateClock, 1000);
	}

	const deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
	initializeClock('clockdiv', deadline);
</script>