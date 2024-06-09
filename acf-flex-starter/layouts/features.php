<?php
// Get ACF values
$columns = get_sub_field('columns') ?: 'auto';
$alignment_class = get_sub_field('alignment');

// Columns class
$columns_class = 'features__columns--' . $columns;
?>

<section class="features">
    <!-- Replace '=container--narrow' with your own container class -->
    <div class="<?= get_css_classes('=container--narrow', $columns_class, $alignment_class); ?>">
        <?php if (have_rows('features')): 
            while (have_rows('features')): the_row();
                $image = get_sub_field('image');
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $link = get_sub_field('link');
                ?>
                <div class="features__item">
                    <?php if ($image): ?>
                        <?= wp_get_attachment_image($image['ID'], 'full'); ?>
                    <?php endif; ?>

                    <?php if ($title): ?>
                        <h3><?= esc_html($title); ?></h3>
                    <?php endif; ?>

                    <?php if ($description): ?>
                        <p><?= esc_html($description); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($link)): ?>
                        <?= get_acf_link($link, 'button'); ?>
                    <?php endif; ?>
                </div>
            <?php endwhile; 
        endif; ?>
    </div>
</section>
