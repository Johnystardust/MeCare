<?php
get_header(); ?>

<?php get_template_part('template-parts/slider/full-page-slider'); ?>

    <div class="container-fluid no-padding page-content">
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php the_content(); ?>

                <?php endwhile; ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>