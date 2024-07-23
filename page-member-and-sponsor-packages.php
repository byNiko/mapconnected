<?php

get_header();
?>


  <main id="primary" class="site-main">
    <header class="text-center container--very-narrow">
      <h1 class="h1">Membership & Sponsorship Packages</h1>
    </header>
    <?php
    // $fields = get_field_objects($post, 'options' );

    // print_r($fields);
    while (have_posts()) :
      the_post();

      get_template_part('template-parts/content', 'page');
    endwhile; // End of the loop.

    $packages = array(
      'brands' => 'brands_membership_group',
      'industry' => 'industry_membership_group',
      'netowrk' => 'warranty_network_sponsorships'
    );
    ?>
<div class="container--wide">
    <div id="pricing-table" class="pricing-table">
      <div class="tabs pricing-table__tabs">
        <ul class="tabs-header pricing-table__header">

          <?php
          // $fields = get_field_objects('options');
          // print_r($fields);
          $count = 0;
         $note = [];

          foreach ($packages as $package) :
            // var_dump($package);

            if (have_rows($package, 'options')) : while (have_rows($package, 'options')) : the_row($package, 'options');
               
                $title = get_sub_field('title');
                $note[$count] = get_sub_field("note");
                $id = sanitize_title($title);
                echo "<li id='$id' class=''>$title</li>";
                $count++;
              endwhile;
            endif;
          endforeach;
          
          ?>
        </ul>
        <ul class="pricing-table__tabs-content tabs-content">

          <?php
         // var_dump($note);
         $label_count = 0;
          foreach ($packages as $package) :
           
            if (have_rows($package, 'options')) : while (have_rows($package, 'options')) : the_row($package, 'options');
           
                echo "<li>";
                echo "<h2 class='h2 text-center subheading my-1'>$note[$label_count]</h2>";
                echo "<ul class=' benefits__wrap '>";
                $label_count++;
                // labels loop
                // if (have_rows('packages', 'options')) : while (have_rows('packages', 'options')) : the_row('packages', 'options');
                //     $label_count++;
                //     if ($label_count === 1) {
                //       echo "<li class='benefit__labels benefit-column-grid'>";
                //       echo "<div class='benefit benefit__label'>title</div>";
                //       echo "<div class='benefit benefit__label'>price</div>";
                //       echo "<div class='benefit benefit__label'>link</div>";
                //       $benefits = get_sub_field('benefits');
                //       $benefit_keys = [];
                //       foreach ($benefits as $key => $value) {
                //         $benefit_keys[] = $key;
                //       }
                //       if (have_rows('benefits', 'options')) : while (have_rows('benefits', 'options')) : the_row('benefits', 'options');
                //           foreach ($benefit_keys as $key) {
                //             $label = acf_get_field($key)['label'];
                //             echo "<div class='benefit benefit__label'>$label</div>";
                //           }
                //         endwhile;
                //       endif;
                //     }
                //     echo "</li>";
                //   endwhile;
                // endif;
                // levels loop
                if (have_rows('packages')) : while (have_rows('packages')) : the_row('packages');
                    $level = get_sub_field('level_name');

                    $price = '$' . number_format(get_sub_field('price'), 0);
                    $link = get_acf_link(get_sub_field('registration_link'), 'button button--accent ');
                    echo "<li class='benefit-column-grid benefits__list'>";
                    echo "<header class='benefit__column-header'>";
                    echo  "<div class='benefit benefit__level benefit__header-item'>$level</div>";
                    echo  "<div class='benefit benefit__price benefit__header-item'>$price</div>";
                    echo  "<div class='benefit benefit__link benefit__header-item'>$link</div>";
                    echo "</header>";
                    $benefits = get_sub_field('benefits');
                    // $benefits = acf_get_field()('benefits');
                    $benefit_keys = [];
                    foreach ($benefits as $key => $value) {
                      $benefit_keys[] = $key;
                    }
                    if (have_rows('benefits', 'options')) : while (have_rows('benefits', 'options')) : the_row('benefits', 'options');
                        foreach ($benefit_keys as $key) {
                          $label = acf_get_field($key)['label'];
                          // echo "<small>($field)</small>";
                          echo "<div class='benefit__item'>
                          <div class='benefit__label'>$label</div>
                          <div class='benefit__value'>" . get_sub_field($key) . "</div>
                          </div>";
                        }

                      endwhile;
                    endif;
                    echo "</li>";;
                  endwhile;
                endif;
                echo "</ul></li>";
              endwhile;
            endif;
          endforeach;

          ?>

        </ul>
      </div>
    </div>
    </div>
  </main><!-- #main -->


<?php get_footer(); ?>