<?php

if(has_post_thumbnail($post->ID)){
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
}

if(is_page($post->ID)){
    $subline = get_post_meta($post->ID, '_top_page_quote', true);
}
if ( is_singular( 'behandelingen' ) ) {
    $subline = get_post_meta($post->ID, '_behandeling_quote', true);
}
if ( is_singular( 'praktijk' ) ) {
    $subline = get_post_meta($post->ID, '_praktijk_quote', true);
}
?>

<!-- Slider -->
<div class="container-fluid no-padding full-page-slider" style="background: url('<?php echo $image[0]; ?>') center; background-size: cover">
    <div class="container">
        <div class="slider-text">
            <h1 class="headline no-margin"><?php the_title(); ?></h1>
            <h2 class="subline"><?php echo $subline ?></h2>
        </div>
    </div>
</div>