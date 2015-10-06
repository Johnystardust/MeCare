<?php
/*
Template Name: Beoordelingen
*/

global $post;

// Submit the form action
$postTitleError = '';

if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

    if(trim($_POST['postTitle']) === '') {
        $postTitleError = 'Please enter a title.';
        $hasError = true;
    } else {
        $postTitle = trim($_POST['postTitle']);
    }


    $post_information = array(
        'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
        'post_content' => esc_attr(strip_tags($_POST['postContent'])),
        'post_type' => 'beoordelingen',
        'post_status' => 'pending'
    );

    $post_id = wp_insert_post($post_information);

    if($post_id)
    {
        // Update Custom Meta
//        update_post_meta($post_id, 'vsip_custom_one', esc_attr(strip_tags($_POST['customMetaOne'])));
//        update_post_meta($post_id, 'vsip_custom_two', esc_attr(strip_tags($_POST['customMetaTwo'])));

        // Redirect
        wp_redirect(home_url());
        exit;
    }

}
?>

<?php get_header(); ?>

<?php include_once('template-parts/slider/full-page-slider.php'); ?>

    <div class="container-fluid no-padding page-custom-beoordelingen page-content">
        <div class="container">
            <?php
            $i = 0;
            $args = array( 'post_type' => 'beoordelingen', 'order' => 'DESC');
            $the_query = new WP_Query($args);

            while($the_query->have_posts() ) : $the_query->the_post(); ?>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row title-stars-row">
                            <div class="col-md-9 title">
                                <h3 class="no-margin"><?php the_title(); ?></h3>
                            </div>
                            <div class="col-md-3 stars">
                                <?php
                                $i              = 0;
                                $n              = 0;
                                $max_stars      = 5;
                                $recieved_stars = get_post_meta($post->ID, '_beoordeling_stars', true);

                                $empty_stars    = $max_stars - $recieved_stars;

                                while($i < $recieved_stars){
                                    echo '<i class="icon-star"></i>';
                                    $i++;
                                }
                                while($n < $empty_stars){
                                    echo '<i class="icon-star-empty"></i>';
                                    $n++;
                                }
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p>Geplaatst op: <?php echo get_the_date(); ?></p>
                                <p>Geplaatst door: <?php echo get_post_meta($post->ID, '_beoordeling_name', true); ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>

    <div class="container-fluid no-padding page-custom-beoordelingen-form">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form action="" id="primaryPostForm" method="POST">
                        <div class="form-group">
                            <label for="postTilte">Titel</label>
                            <input type="text" name="postTitle" id="postTitle" class="form-control" value="<?php if(isset($_POST['postTitle'])) echo $_POST['postTitle'];?>" class="required" />
                        </div>

                        <div class="form-group">
                            <label for="name">Naam</label>
                            <input type="text" name="_beoordeling_name" id="name" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail <small>(wordt niet getoond)</small></label>
                            <input type="text" name="_beoordeling_email" id="email" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="postContent">Beoordeling</label>
                            <textarea name="postContent" id="postContent" class="form-control" rows="8" cols="30"><?php if(isset($_POST['postContent'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['postContent']); } else { echo $_POST['postContent']; } } ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="stars">Waardering</label>
                            <div class="col-md-12 no-padding">
                                <input type="radio" name="_beoordeling_stars" value="5"/><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                                <input type="radio" name="_beoordeling_stars" value="4"/><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                                <input type="radio" name="_beoordeling_stars" value="3"/><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                                <input type="radio" name="_beoordeling_stars" value="2"/><i class="icon-star"></i><i class="icon-star"></i>
                                <input type="radio" name="_beoordeling_stars" value="1"/><i class="icon-star"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>

                            <input type="hidden" name="submitted" id="submitted" value="true" />
                            <button class="btn btn-primary" type="submit">Add Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>