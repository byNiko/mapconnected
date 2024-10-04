<?php

/**
 * Template Name: Past Attendees
 */

get_header();
?>
<div class="container-fluid">
  <main id="primary" class="">
    <div class="container--very-narrow">
      <?php
      while (have_posts()) :
        the_post();
        echo "<header class='text-center pt-4 h3'><h1>" . $post->post_title . "</h1></header>";
        the_content();
      endwhile; // End of the loop.
      ?>
    </div>
    <hr>
    <?php if ($gallery = get_field('past_attendees_logos','options')) :   ?>
      <div id="attendee-gallery" class="flex-gallery">
        <?php foreach ($gallery as $image) :   ?>
          <div class="flex-gallery__item fade_in_up">
            <?= wp_get_attachment_image($image, 'medium'); ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </main><!-- #main -->
</div>
<style>
  /** flex-gallery **/

  
  </style>


<?php get_footer(); ?>