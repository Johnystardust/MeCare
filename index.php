<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package modularcontent
 */

get_header(); ?>

<?php get_template_part('template-parts/slider/home-slider'); ?>

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
        <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
