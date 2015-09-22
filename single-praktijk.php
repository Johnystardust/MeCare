<?php
get_header(); ?>

<?php get_template_part('template-parts/page-slider'); ?>

    <div class="container-fluid no-padding page-content">
        <div class="container">
            <?php while ( have_posts() ) : the_post(); ?>

                <?php the_content(); ?>

            <?php endwhile; ?>
        </div>
    </div>

<?php get_footer(); ?>