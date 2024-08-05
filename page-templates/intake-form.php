<?php /* Template Name: Intake Form Template */ ?>

<?php acf_form_head(); ?>
<?php get_header(); ?>
<div class="container--very-narrow">
	<main id="primary" class="site-main">
		<?php
		while (have_posts()) :
			the_post();
			$updated = get_query_var('updated');
		if ($updated) : ?>
			<header>
				<h1>Info submitted</h1>
				<h3 class="h3">Thanks! We got your info.</h3>
			</header>
			<?php
			else:
				$title = get_the_title();
			echo "<h1 class='page_title h1'>  $title </h1>";
			the_content();
			endif;
		endwhile; // End of the loop.
		?>
	</main><!-- #main -->
</div>
<?php //get_sidebar('sidebar'); 
?>
<?php get_footer(); ?>