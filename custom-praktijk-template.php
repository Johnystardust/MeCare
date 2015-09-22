<?php
/*
Template Name: De Praktijk
*/

global $post;

get_header(); ?>

<?php include_once('template-parts/page-slider.php'); ?>

<div class="container-fluid no-padding page-custom-behandelingen">
    <div class="container">
        <div class="three-blocks">

            <?php
            $i = 0;
            $args = array( 'post_type' => 'praktijk', 'order' => 'ASC');
            $the_query = new WP_Query($args);

            while($the_query->have_posts() ) : $the_query->the_post(); ?>

                // add the content here


            <?php endwhile; wp_reset_postdata(); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
