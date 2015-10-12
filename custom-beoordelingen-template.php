<?php
/*
Template Name: Beoordelingen
*/

global $post;
//$form_errors = array();
//
//
//// Submit the form action
//if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {
//
//    // Validate the fields
//    if(empty($_POST['postTitle']) || empty($_POST['_beoordeling_name']) || empty($_POST['_beoordeling_email']) || empty($_POST['postContent']) || empty($_POST['_beoordeling_stars'])){
//        array_push($form_errors, 'Velden mogen niet leeg zijn.');
//    }
//    if(strlen($_POST['beoordeling_name']) < 4){
//        array_push($form_errors, 'Naam moet ten minste 4 letters zijn.');
//    }
//    if( !is_email($_POST['beoordeling_email']) ) {
//        array_push( $form_errors, 'Geen geldig e-mail adres.' );
//    }
//
//    if(is_array($form_errors)){
//        echo '<div class="form-errors">';
//        foreach($form_errors as $error ) {
//            echo '<h4><span class="label label-danger">Error: '.$error.'</span></h4>';
//        }
//        echo '</div>';
//    }
//
//    // Process the fields
//    $post_information = array(
//        'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
//        'post_content' => esc_attr(strip_tags($_POST['postContent'])),
//        'post_type' => 'beoordelingen',
//        'post_status' => 'pending'
//    );
//
//    $post_id = wp_insert_post($post_information);
//
//    if($post_id)
//    {
//        // Update Custom Meta
//        //update_post_meta($post_id, 'vsip_custom_one', esc_attr(strip_tags($_POST['customMetaOne'])));
//        //update_post_meta($post_id, 'vsip_custom_two', esc_attr(strip_tags($_POST['customMetaTwo'])));
//
//        // Redirect
//        wp_redirect(home_url());
//        exit;
//    }
//
//}
?>

<?php get_header(); ?>

<?php get_template_part('template-parts/slider/full-page-slider'); ?>

    <div class="container-fluid no-padding page-custom-beoordelingen page-content">
        <div class="container">
            <?php
            $i = 0;
            $args = array( 'post_type' => 'beoordelingen', 'order' => 'DESC');
            $the_query = new WP_Query($args);

            while($the_query->have_posts() ) : $the_query->the_post(); ?>

                <div class="row beoordeling-single">
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
                            <div class="col-md-12 beoordeling-info">
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
                    <?php echo do_shortcode('[tvds_beoordeling_form]'); ?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>