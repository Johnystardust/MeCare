<?php ?>
<!-- 3 blocks -->
<div class="container-fluid no-padding three-blocks">
    <div class="container">
        <div class="row">
            <div class="col-md-4 block">
                <div class="block-header">
                    <div class="tag-line">
                        <span>De Praktijk</span>
                    </div>
                </div>
                <div class="block-text">
                    <p>
                        <?
                        $the_query = new WP_Query( 'page_id=46' );

                        while ( $the_query->have_posts() ) : $the_query->the_post();
                            the_content();
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </p>
                    <span class="btn btn-green"><a href="<?php echo get_page_link(46); ?>">Lees meer</a></span>
                </div>
            </div>

            <div class="col-md-4 block">
                <div class="block-header">
                    <div class="tag-line">
                        <span>Bodycheck</span>
                    </div>
                </div>
                <div class="block-text">
                    <p>
                        Een bodycheck is een gezondheidsmeting met behulp van Bioresonantie. Lichaamscellen functioneren optimaal bij voldoende energie (trilling). Blokkades in de energie veroorzaken
                        klachten. Een meting door middel van Bioresonantie geeft aan waar in het lichaam de energie goed stroomt en waar niet. Klachten worden verklaard of voorkomen door
                        tijdig een disbalans te signaleren en te herstellen. Bij een bodycheck hoort een helder behandelplan. Indien gewenst worden analyse en plan vormgegeven in een helder rapport.
                    </p>
                    <span class="btn btn-green"><a href="<?php echo get_page_link(43); ?>">Lees meer</a></span>
                </div>
            </div>

            <div class="col-md-4 block">
                <div class="block-header">
                    <div class="tag-line">
                        <span>Behandelingen</span>
                    </div>
                </div>
                <div class="block-text">
                    <p>
                        <?
                        $the_query = new WP_Query( 'page_id=5' );

                        while ( $the_query->have_posts() ) : $the_query->the_post();
                            the_content();
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </p>
                    <span class="btn btn-green"><a href="<?php echo get_page_link(5); ?>">Lees meer</a></span>
                </div>
            </div>
        </div>
    </div>
</div>