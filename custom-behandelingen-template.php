<?php
/*
Template Name: Behandelingen
*/

global $post;

get_header(); ?>

<?php include_once('template-parts/page-slider.php'); ?>

<div class="container-fluid no-padding page-custom-behandelingen">
    <div class="container">
        <div class="three-blocks">

            <?php
            $i = 0;
            $args = array( 'post_type' => 'behandelingen', 'order' => 'ASC');
            $the_query = new WP_Query($args);

            while($the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php
                    if($i == 0 || $i == 3){
                        echo '<div class="row">';
                    }
                ?>

                <div class="col-md-4 block">
                    <div class="block-icon">
                        <img src="<?php echo wp_get_attachment_url(get_post_meta($post->ID, '_behandeling_icon', true)); ?>" width="35%"/>
                    </div>
                    <div class="block-header">
                        <div class="tag-line">
                            <span><?php the_title(); ?></span>
                        </div>
                    </div>
                    <div class="block-text">
                        <p>
                            <?php echo get_post_meta($post->ID, '_behandeling_description', true) ?>
                        </p>
                        <span class="label label-green"><a href="<?php echo the_permalink(); ?>">Lees meer</a></span>
                    </div>
                </div>

                <?php
                if($i == 2 || $i == 5){
                    echo '</div>';
                }
                $i ++;
                ?>


            <?php endwhile; wp_reset_postdata(); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
