<?php
/*
Template Name: De Praktijk
*/

global $post;

get_header(); ?>

<?php include_once('template-parts/slider/full-page-slider.php'); ?>

<div class="container-fluid no-padding page-custom-praktijk page-content">
    <div class="container">
        <?php
        $i = 0;
        $args = array( 'post_type' => 'praktijk', 'order' => 'ASC');
        $the_query = new WP_Query($args);

        while($the_query->have_posts() ) : $the_query->the_post(); ?>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h3><?php the_title(); ?></h3><br/>
                    <?php the_content(); ?>
                </div>
            </div>

        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>

<?php get_footer(); ?>
