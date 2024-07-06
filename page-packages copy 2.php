<?php

get_header();
?>
<div class="container">
  <main id="primary" class="site-main">
    <?php
    // $fields = get_field_objects($post, 'options' );

    print_r($fields);
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

    <div id="pricing_table">
      <div class="tabs">
        <ul class="tabs-header">
          <?php
          // $fields = get_field_objects('options');
          // print_r($fields);
          $count = 0;

          foreach ($packages as $package) :
            // var_dump($package);
            if (have_rows($package, 'options')) : while (have_rows($package, 'options')) : the_row($package, 'options');
                $count++;
                echo "<li class=''>" . get_sub_field('title') . "</li>";
              endwhile;
            endif;
          endforeach;
          ?>
        </ul>
        <ul class="tabs-content">
          <?php
          foreach ($packages as $package) :
            $label_count = 0;
            if (have_rows($package)) : while (have_rows($package)) : the_row($package);
                echo "<li><ul class=' benefits--wrap'>";

                // labels loop

                if (have_rows('packages')) : while (have_rows('packages')) : the_row('packages');
                    $label_count++;
                    if ($label_count === 1) {
                      echo "<li class='benefit-labels benefit-column-grid'>";
                      echo "<div class='benefit benefit-label'>title</div>";
                      echo "<div class='benefit benefit-label'>price</div>";
                      echo "<div class='benefit benefit-label'>link</div>";
                      $benefits = get_sub_field('benefits');
                      // print_r($benefits);
                      // $benefits = acf_get_field()('benefits');
                      $benefit_keys = [];
                      foreach ($benefits as $key => $value) {
                        $benefit_keys[] = $key;
                      }
                      if (have_rows('benefits')) : while (have_rows('benefits')) : the_row('benefits');
                          foreach ($benefit_keys as $key) {
                            $label = acf_get_field($key)['label'];
                            echo "<div class='benefit benefit-label'>$label</div>";
                          }
                        endwhile;
                      endif;
                    }
                    echo "</li>";
                  endwhile;
                endif;
                // $field = get_sub_field_object('level_name');
                // var_dump($field['label']);
                // echo "<li>" ;
                // levels loop
                if (have_rows('packages')) : while (have_rows('packages')) : the_row('packages');
                    $level = get_sub_field('level_name');
                    $price = get_sub_field('price');
                    $link = get_acf_link(get_sub_field('registration_link'));
                    echo "<li class='benefit-column-grid benefits-list'>";
                    echo  "<div class='benefit level'>$level</div>";
                    echo  "<div class='benefit price'>$price</div>";
                    echo  "<div class='benefit link'>$link</div>";
                    $benefits = get_sub_field('benefits');
                    // $benefits = acf_get_field()('benefits');
                    $benefit_keys = [];
                    foreach ($benefits as $key => $value) {
                      $benefit_keys[] = $key;
                    }
                    if (have_rows('benefits')) : while (have_rows('benefits')) : the_row('benefits');
                        foreach ($benefit_keys as $key) {
                          //   $field = acf_get_field($key)['label'];
                          //   echo "<small>($field)</small>";
                          echo "<div class='benefit'>" . get_sub_field($key) . "</div>";
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
  </main><!-- #main -->
</div>

<?php get_footer(); ?>