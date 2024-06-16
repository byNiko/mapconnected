<?php
load_class("Sponsor");
load_class("Sponsorships");
$spships = new Sponsorships();



// $sp->get_sponsors();
get_header(); ?>

<main class="annual_summit">
	<section class="hero theme--dark-gradient-1">
		<div class="secondary-nav__wrapper">
			<nav class="secondary-nav">
				<button class="button--text">Speakers</button>
				<button class="button--text">Agenda</button>
				<button class="button--text">Sponsors</button>
				<button class="button--text">Become a Sponsor</button>
				<button class="button--text">Download Brochure</button>
			</nav>
		</div>
		<div class="container--narrow landing__container">
			<div class="summit-logo">
				<?= wp_get_attachment_image(892, 'full'); ?>
			</div>
			<div class="landing__text">
				Analytics, Data, and Service: <br>
				Fuel For A Customer-First Connected World
			</div>
			<div class="glass">
				<div class=" flex-row justify--center text-center ">
					<div class="bold-stat">
						<div class="bold-stat__number">200<sup>+</sup></div>
						<div class="bold-stat__title">Attendees</div>
					</div>
					<div class="bold-stat">
						<div class="bold-stat__number">80<sup>+</sup></div>
						<div class="bold-stat__title">Companies</div>
					</div>
					<div class="bold-stat">
						<div class="bold-stat__number">50<sup>+</sup></div>
						<div class="bold-stat__title">Speakers</div>
					</div>
					<div class="bold-stat">
						<div class="bold-stat__number">15</div>
						<div class="bold-stat__title">sponsors</div>
					</div>
				</div>
			</div>
			<div class="landing__ctas">
				<div class="flex-row justify--center">
					<a href="#" class="button button--accent button--lg">
						Register Now!
					</a>
				</div>
			</div>

		</div>
	</section>
	<section id="key-speakers" class="key-speakers">
		<div class="container">
			<div class="row">
				<h2 class="h2 col">Key Speakers</h2>
				<div class="col">
					<h3>How do we want to admin the speakers</h3>
					<ul>
						<li>mark each speaker (already in the database) individually as a key-speaker / regular-speaker for the summit</li>
						<li>Have a summit post type that you'd attach all speakers to
							<ul>
								<li>
									in this case you won't be able to have an archive of who spoke at which summit
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<section id="summary">
		<div class="container--narrow">
			<div class="flex-row __2x inner-container theme--medium-2">
				<div class="col">
					<?php echo wp_get_attachment_image(426, 'full'); ?>
				</div>
				<div class="col">
					<header>
						<h3 class="h3">Who attends MAPconnected Warranty, Aftersales and Aftercare Services Professionals?</h3>
						<div class="content">
							<p>When you join you become part of a select executive group who are responsible for the design and execution of Warranty, Recall, Aftersales, Technical Services, Customer Care Management and Support Services. </p>
							<p>The network represents Leading OEMs, Component Manufacturers & Aftermarket Suppliers, and their Network of Retailers, Dealers and Aftercare Services & Technology Providers. </p>
						</div>
					</header>
				</div>
			</div>
		</div>
	</section>
	<section id="highlights">
		<div class="container--narrow">
			<div class="flex-column gap-1">
				<h2 class="h2 text-center">Agenda Highlights</h3>
					<div class="content flex-row __2x">
						<div class="col">
							<dl>
								<dt>AI & PREDICTIVE ANALYTICS </dt>
								<dd>Debugging Dedicated Financial & Quality Tracks using AI & PREDICTIVE ANALYTICS</dd>
								<dt>ROOT CAUSE ANALYSIS</dt>
								<dd>Using warranty data for improved administration, QUALITY AND SUPPLIER MANAGEMENT and ROOT CAUSE ANALYSIS</dd>
								<dt>TELEMATICS</dt>
								<dd>Best practices on advanced uses of TELEMATICS data</dd>
								<dt>WARRANTY EDITS</dt>
								<dd>Advanced WARRANTY EDITS – what works and what doesn’t?</dd>
							</dl>
						</div>
						<div class="col">
							<dl>
								<dt>LEGAL & REGULATORY</dt>
								<dd>The LEGAL & REGULATORY world continues to evolve. What’s the latest and next?</dd>
								<dt>TECHNICIAN: TOOLS AND DIAGNOSTICS</dt>
								<dd>Training, hiring and retention</dd>
								<dt>OVER-THE-AIR-UPDATES</dt>
								<dd>Staying connected with the customer, OVER-THE-AIR-UPDATES, and input from NHTSA related to field service actions</dd>
								<dt>WARRANTY IMPROVEMENT INITIATIVES</dt>
								<dd>Informative case studies on successful WARRANTY IMPROVEMENT INITIATIVES</dd>
							</dl>
						</div>
					</div>
			</div>
		</div>
	</section>
	<section id="title-section" class="title-section">
		<header class="text-center">
			<div class="fz-xxxl fw-extra-bold summit-title">The Future is Now.</div>
			<div class="summit-subtitle">Data Driven Decisions</div>
		</header>
		<div class="container--narrow">
			<div class="flex-row __2x">
				<div class="col">
					<div class="text-block">
						<p>Learn how to get the most out of your data!</p>
						<p>The 2024 Summit will explore powerful strategies for collecting, understanding, and using data to make better decisions, using the latest tools and proven methods.</p>
						<p>Gain valuable insights from industry experts on the latest technology and techniques.</p>
					</div>
					<a href="" class="button button--accent fw-semi-bold button--full-width">Register Now!</a>
				</div>
				<div class="col flex-column gap-1">
					<div class="video-container">
						<?php $content =  wp_get_attachment_url(480); ?>
						<?php
						// Attributes of the shortcode.
						$attr = array(
							'src'        =>  wp_get_attachment_url(480),
							'height'     => 360,
							'width'      => 640,
							'poster'     => '',
							'loop'       => '',
							'autoplay'   => '',
							'muted'      => 'false',
							'preload'    => 'metadata',
							'class'      => 'wp-video-shortcode',
						);

						echo wp_video_shortcode($attr);
						?>

					</div>
					<div class="flex-row justify--center">
						<a href="#" class="button button--secondary">Become a Sponsor</a>
						<a href="#" class="button button--secondary">Become a Speaker</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	$args = array(
		'post_type' => "testimonial"
	);
	$q = new WP_Query($args);

	?>
	<section id="single-testimonial" class="single-testimonial">
		<div class="container--single-column">
			<div class="flex-column inner-container">
				<blockquote>
					Experts and professionals representing many facets of the automotive warranty industry were in attendance sharing best practices and success stories. Speakers presented on useful topics of interest to me as Tier 1 OEM supplier. Excellent networking and knowledge sharing all around. Highly recommend.
				</blockquote>
			</div>
		</div>
	</section>
	<section>
		<div class="container--very-narrow">
			<div class="flex-column">
				<h2 class="h2 text-center">Introducing New 2024 Formats to Adress the Needs Of The Rapidly Evolving World </h2>
				<div class="text-content">
					<p>As the Summit expands, MAPconnected stays devoted to crafting and introducing novel thematic tracks and interactive formats, guided by the needs of our industry members and participants. </p>
				</div>
			</div>
			<div class="flex-row justify--center">
				<button class="button button--primary">Get Summit Updates</button>
				<button class="button--text fz-lg">Get the Full Agenda</button>
			</div>
		</div>
	</section>

	<section id="all-leadership" class="all-leadership">
		<div class="container--narrow">
			<header class="flex-column">
				<h3 class="h3 text-center">A Snapshot look to the 2023 speakers</h3>
				<div class="text-center d-flex justify--center">
					<a href="#" class="button button-secondary button--outline">Learn More About Our Speakers</a>
				</div>
			</header>
			<div id="who-attends">
				<div class="flex-row __2x inner-container theme--medium-2">
					<div class="col">
						<?php echo wp_get_attachment_image(426, 'full'); ?>
					</div>
					<div class="col">
						<header>
							<h3 class="h3">Who You’ll Meet There</h3>
							<div class="content">
								<p>Leading OEMs, Component Manufacturers & Aftermarket Suppliers, and their Network of Retailers, Dealers and Aftercare Services & Technology Providers. </p>
								<div class="fw-semi-bold">Key Job Titles</div>
								<ul>
									<li><strong>Warranty (Factory & Extended):</strong> Strategy | Ops | Claims | Parts Return   </li>
									<li><strong>Finance:</strong> Accruals | Audits</li>
									<li><strong>Purchasing:</strong> Supply Chain | Supplier Cost Sharing</li>
									<li><strong>Data & Analytics:</strong> Systems | Support | Analysts </li>
									<li><strong>Technical:</strong> Field Services | Dealer Administration | EV Services | Training </li>
									<li><strong>Customer:</strong> Recalls | Safety | Campaigns | Customer Service </li>
									<li><strong>Dealer:</strong> Aftersales | Aftercare Services | Reporting | Publications | Training  </li>
									<li><strong>Quality:</strong> Manufacturing | Engineering  </li>
									<li><strong>Marketing:</strong> Customer Experience | Product Design</li>
									<li><strong>Legal:</strong> Regulatory | Compliance </li>
									<li><strong>Insurance & Financial Products</strong> </li>
								</ul>
							</div>
						</header>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="must-attend" class="theme--dark-gradient-1">
		<div class="container--single-column">
			<header class="text-center">
				<h2 class="h2 ">Why is Service and Warranty Lifecycle Summit a Must-Attend?</h2>
				<div class="subtitle">MAPconnected's interactive engagement and networking opportunities</div>
			</header>
		</div>
		<div class="container--narrow">
			<div class="flex-row">
				<div class="image-card flex-column theme--light-1">
					<div class="card__title text-center h3 fw-semi-bold">Connect</div>
					<div class="card__image-wrap"><img src="//localhost:3000/wp-content/uploads/jj-ying-8bghKxNU1j0-unsplash-e1716688425606-300x100.jpg " alt=""></div>
					<div class="card__content">In-depth discussions across full Warranty Lifecycle filled with Best Practice Presentations & Fireside Chats </div>
				</div>
				<div class="image-card flex-column theme--light-1">
					<div class="card__title text-center h3 fw-semi-bold">Collaborate</div>
					<div class="card__image-wrap"><img src="//localhost:3000/wp-content/uploads/hivan-arvizu-soyhivan-MAnhvw0nDDY-unsplash-e1716688362903-300x100.jpg " alt=""></div>
					<div class="card__content">Working together through Roundtables to enhance and streamline warranty and aftercare end-to-end experiences</div>
				</div>
				<div class="image-card flex-column theme--light-1">
					<div class="card__title text-center h3 fw-semi-bold">Benchmark</div>
					<div class="card__image-wrap"><img src="//localhost:3000/wp-content/uploads/jj-ying-8bghKxNU1j0-unsplash-e1716688425606-300x100.jpg " alt=""></div>
					<div class="card__content">Exchange latest technology and data usage processes during interactive workshops.</div>
				</div>
			</div>
		</div>
	</section>

	<section id="sponsorships" class="sponsorships">
		<div class="container">
			<?php
			$levels = ["Gold", "Silver", "Bronze"];
			foreach ($levels as $level) :
				$sps = $spships->get_sponsors_by_level($level);
			?>
				<h3 class="text-center"><?= $level; ?> Sponsors</h3>
				<div class="flex-row align-center justify--center">
					<?php foreach ($sps as $p) : ?>
						<?php $s = new Sponsor($p); ?>
						<div class="sponsor__logo__wrapper sponsor-level--<?= strtolower($level); ?>"
						style="background-image:url(<?=$s->get_logo_image_src();?>);">
							<a class="sponsor__link" href="<?= $s->get_sponsor_page_link(); ?>">
								<?//= $s->get_logo_image(); ?>
							</a>
							<!-- <?php //print_r($s->get_sponsorship_level()); 
									?> -->
						</div>
					<?php endforeach; ?>

				</div>
			<?php endforeach; ?>
		</div>
	</section>

</main>


<?php
get_footer();
