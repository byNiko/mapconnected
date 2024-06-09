<?php
echo "what";
// Check if the flexible content field has rows of data
if (have_rows('layouts')):

    // Slider counter (required for aria-control)
    $slider_counter = 0;

    // Loop through the rows of data
    while (have_rows('layouts')): the_row();

        // Get layout
        $layout = get_row_layout();

        // Increment the counter for each slider
        if ($layout == 'slider' || $layout == 'testimonials') {
            $slider_counter++;
            set_query_var('slider_id', 'slider-' . $slider_counter);
        }

        // Include the layout file
        get_template_part('acf-flex-starter/layouts/' . $layout);

    endwhile;

endif;