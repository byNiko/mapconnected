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
          
          $count = 0;
          foreach ($packages as $package) :
            var_dump($package);
            // $count++;
            // $class = $count === 1 ? "default-tab" : null;
            // $title = $package["title"];
            // echo "<li class='$class'>$title</li>";

          //   if(have_rows($package)): while(have_rows($package)): the_row($package);
          //   echo "what";
          // endwhile; endif;

          endforeach;
          ?>
        </ul>
        <ul class="tabs-content">
          <?php
          $count = 0;
          foreach ($packages as $package) :
            // $title = $package["title"];
            // $note = $package["note"];
            //print_r($package);
          ?>
            <li class="tab">
              <!-- <?= $title; ?> -->
              <!-- <?= $note; ?> -->
              <ul class="d-flex no-bullets">
                <?php //foreach ($package['packages'] as $package) :
                //$price = $package["price"];
                //$registration_link = get_acf_link($package["registration_link"]);
                ?>
                  <li>
                    <?php
                    echo "<div>". $package['level_name']."</div>";
                    echo "<div>$price</div>";
                    echo "<div>$registration_link</div>";
                    // echo $package['price'];
                    // echo get_acf_link($package['registration_link']);
                    // print_r($package['benefits']);
                    foreach ($package['benefits'] as $key) :
                    // echo "<div>$value</div>";
                    // var_dump($value);
                    $field = get_sub_field_object($key);
                    // echo $field['label'];
                    var_dump($field);
                    // var_dump( $field);
                    // echo "<pre>". ($key). "</pre>";
                    endforeach;
                    // echo "<pre>".print_r($package). "</pre>";
                    // foreach($package['level_name'] as $level):
                    // print_r($level);
                    // endforeach;
                    ?>
                  </li>
                <?php
                endforeach;
                ?>

              </ul>
            </li>

          <?php
          endforeach;
          ?>
        </ul>
      </div>
    </div>
  </main><!-- #main -->
</div>

<?php get_footer(); ?>