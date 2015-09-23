<?php
/*
Template Name: Contact
*/

get_header(); ?>

<?php get_template_part('template-parts/page-slider'); ?>

    <div class="container-fluid no-padding page-content">
        <div class="container">
            <?php while ( have_posts() ) : the_post(); ?>

                <?php the_content(); ?>

            <?php endwhile; ?>
        </div>
    </div>

    <div class="container-fluid no-padding page-contact-and-maps">
        <div class="container">
            <div class="col-md-6 padding-right">
                <?php echo do_shortcode('[tvds_contact_form]'); ?>
            </div>
            <div class="col-md-6 padding-left">
                <script src="https://maps.googleapis.com/maps/api/js"></script>
                <script>
                    function initialize() {
                        var mapCanvas = document.getElementById('map-canvas');
                        var myLatLng = new google.maps.LatLng(51.9794907, 5.9095527,17);
                        var mapOptions = {
                            center: myLatLng,
                            zoom: 14,
                            scrollwheel: false,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            disableDefaultUI:false
                        };
                        var map = new google.maps.Map(mapCanvas, mapOptions);
                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            map: map,
                            title: 'MeCare',
                            animation: google.maps.Animation.DROP
                        });
                        var contentString = '<div id="content">' +
                            '<div class="siteNotice">' +
                            '</div>MeCare</div>';
                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });
                        google.maps.event.addListener(marker, 'click', function(){
                            infowindow.open(map, marker);
                        });
                        infowindow.open(map, marker);
                    }
                    google.maps.event.addDomListener(window, 'load', initialize);
                </script>
                <div id="map-canvas" style="height: 436px;"></div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>