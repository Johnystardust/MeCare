<?php
/*
Template Name: Home Pagina
*/

global $post;

get_header(); ?>

<?php include_once('template-parts/slider/full-page-slider.php'); ?>

<?php get_template_part('template-parts/three-blocks'); ?>

<div class="container-fluid no-padding home-custom-beoordelingen page-content">
    <div class="container">
        <div class="row">
            <?php
            $i = 0;
            $args = array( 'post_type' => 'beoordelingen', 'order' => 'DESC', 'posts_per_page' => 3);
            $the_query = new WP_Query($args);

            while($the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="col-md-4">
                    <div class="row title-stars-row">
                        <div class="col-md-12 title">
                            <h3 class="no-margin"><?php the_title(); ?></h3>
                        </div>
                        <div class="col-md-12 stars">
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
                            <p>Geplaatst door: <?php echo get_post_meta($post->ID, '_beoordeling_name', true); ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div class="row button-row">
            <span class="btn btn-green"><a href="<?php echo get_page_link(83); ?>">Bekijk hier alle beoordelingen</a></span>
        </div>
    </div>
</div>

<?php get_footer(); ?>
