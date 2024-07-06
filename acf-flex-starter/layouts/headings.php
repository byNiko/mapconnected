<?php
// Get ACF values
$headings = get_sub_field('headings');
if(!$headings) return;
$section_heading = $headings['section_heading'];
$heading_font_size = "fz-". $headings['heading_size'];
$sub_heading = $headings['sub_heading'];
$theme_group = $headings['theme_group'];
$container_class = $theme_group['container_width'] !=='false'? "container--".$theme_group['container_width'] : false;
$theme_color = 'theme--'.$theme_group['theme'];

if ($section_heading || $sub_heading) : ?>
	<header class="section-header flexible-content-wrap text-center <?=$theme_color;?>">
		<h2 class="<?= $heading_font_size;?>"><?= $section_heading; ?> </h2>
		<div class="subtitle h4"><?= $sub_heading; ?></div>
	</header>
<?php endif;   ?>
