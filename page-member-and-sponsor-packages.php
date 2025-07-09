<?php

get_header();
?>


<main id="primary" class="site-main">
  <header class="text-center container--very-narrow pt-4 pb-2">
    <h1 class="h1"><?php the_title();?> </h1>
  </header>
  <?php
  while (have_posts()) :
    the_post();

    get_template_part('template-parts/content', 'page');
  endwhile; // End of the loop.
  ?>
  <div class="container--wide">
    <div id="pricing-table" class="pricing-table">
      <div class="tabs pricing-table__tabs">
        <ul class="tabs-header pricing-table__header">

          <?php

          if (have_rows('package_categories', 'options')) : while (have_rows('package_categories', 'options')) : the_row('package_categories', 'options');

              $title = get_sub_field('title');
              $note = get_sub_field("note");
              $id = sanitize_title($title);
              echo "<li id='$id' class=''>$title</li>";
            endwhile;
          endif;
          ?>
        </ul>
        <ul class="pricing-table__tabs-content tabs-content">

          <?php

          if (have_rows('package_categories', 'options')) : while (have_rows('package_categories', 'options')) : the_row('package_categories', 'options');

              echo "<li>";
              echo "<h2 class='h2 text-center subheading my-1'>$note</h2>";
              echo "<ul class=' benefits__wrap '>";
              // $label_count++;
              if (have_rows('packages')) : while (have_rows('packages')) : the_row();
                  $level = get_sub_field('level_name');
                  $price = get_sub_field('price');
                  if (is_numeric($price))
                    $price = '$' . number_format($price, 0);
                  $link = get_acf_link(get_sub_field('registration_link'), 'button button--accent ');

                  echo "<li class='benefit-column-grid benefits__list'>";
                  echo "<header class='benefit__column-header'>";
                  echo  "<div class='benefit benefit__level benefit__header-item'>$level</div>";
                  echo  "<div class='benefit benefit__price benefit__header-item'>$price</div>";
                  echo  "<div class='benefit benefit__link benefit__header-item'>$link</div>";
                  echo "</header>";
                  if (have_rows('benefit')) : while (have_rows('benefit')) : the_row();
                      $label = get_sub_field('title');
                      echo "<div class='benefit__item'>
                          <div class='benefit__label'>$label</div>
                          <div class='benefit__value'>" . get_sub_field('description') . "</div>
                          </div>";
                    endwhile;
                  endif;
                  echo "</li>";;
                endwhile;
              endif;
              echo "</ul></li>";
            endwhile;
          endif;
          ?>

        </ul>
      </div>
    </div>
  </div>
</main><!-- #main -->


<?php get_footer(); ?>