<?php
// Get ACF values
$alignment_class = get_sub_field('image_text_alignment');
$mobile_order = get_sub_field('mobile_order');
$background_color = get_sub_field('background_color');
$columns = get_sub_field('columns');
$theme = get_sub_field('theme_group');
$theme_class = $theme && $theme['theme']==='false'?  false : 'theme--'. $theme['theme'];
$padding_class= $theme_class ? 'has_background' : false;
$is_single_col = count($columns) === 1;
$container_class = $is_single_col?  'container--single-column' :'container--narrow';
?>

<section class="media-text">
    <!-- Replace '=container--narrow' with your own container class -->
    <div class="<?= get_css_classes($container_class, $alignment_class, $theme_class, $padding_class); ?>" >


        <?php if (have_rows('columns')) : ?>
            <div class="flex-row" >
                <?php
                while (have_rows('columns')) : the_row();
                    // Get image or text content type
                    $content_type = get_sub_field('content_type');

                    // Class for mobile ordering
                    $mobile_order_class = ($content_type === $mobile_order) ? 'mobile-order-first' : '';

                    // If content type video_file
                    if ($content_type === 'video_file') :
                        $video_file = get_sub_field('video_file');

                        if (!empty($video_file)) : ?>
                            <div class="<?= get_css_classes('media-text__block media-text__block--image', $mobile_order_class); ?>">
                                <?= apply_filters('the_content', $video_file); ?>
                            </div>
                        <?php endif;
                    // If content type image
                    elseif ($content_type === 'video_embed') :
                        $videoUrl = get_sub_field('video_link');

                        if (!empty($videoUrl)) : ?>
                            <div class="<?= get_css_classes('media-text__block media-text__block--image', $mobile_order_class); ?>">
                                <?= apply_filters('the_content', $videoUrl); ?>
                            </div>
                        <?php endif;

                    // If content type image
                    elseif ($content_type === 'image') :
                        $image = get_sub_field('image');

                        if (!empty($image)) : ?>
                            <div class="<?= get_css_classes('media-text__block media-text__block--image', $mobile_order_class); ?>">
                                <?= wp_get_attachment_image($image['ID'], 'full'); ?>
                            </div>
                        <?php endif;

                    // If content type test
                    elseif ($content_type === 'text') :

                        $heading = get_sub_field('heading');
                        $text = get_sub_field('text');
                        $link = get_sub_field('link');
                        $text_font_size = get_sub_field('text_font_size');
                        $textAlign = $is_single_col? "text-center" : false;
                        ?>

                        <div class="<?= get_css_classes('media-text__block media-text__block--text', $mobile_order_class); ?>">
                            <?php if (!empty($heading)) : ?>
                                <header class="<?= $textAlign;?> " >
                                <h3 class="h3"><?= esc_html($heading); ?></h3>
                                </header>
                            <?php endif; ?>

                            <?php if (!empty($text)) : ?>
                                <div style="font-size: var(--font-size--body-<?= $text_font_size; ?>)">
                                    <?= $text; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($link)) : ?>
                                <?= get_acf_link($link, 'button'); ?>
                            <?php endif; ?>
                        </div>
                <?php
                    endif;
                endwhile;
                ?>
            </div>
        <?php endif; ?>
    </div>
</section>
