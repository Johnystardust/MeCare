<?php
$secondary_image_url = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'secondary-image');

if(is_page($post->ID)){
    $subline = get_post_meta($post->ID, '_bottom_page_quote', true);
}
?>

<div class="footer-img" style="background: url('<?php echo $secondary_image_url; ?>') center; background-size: cover">
    <div class="container">
        <div class="footer-text text-center">
            <h2 class="no-margin"><?php echo $subline ?></h2>
        </div>
    </div>
</div>