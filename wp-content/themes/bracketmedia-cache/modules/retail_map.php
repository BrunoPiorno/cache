<?php 

    echo do_shortcode('[wpsl template="default"]');
    
    if (have_rows('retail_map')) : ?>
        <!--<div class="acf-map" data-zoom="16" style="width:1200px; height: 600px; margin-left: 25%; margin-right: 25%">-->
            <?php # while (have_rows('retail_map')) : the_row();

                // Load sub field values.
                //$location = get_sub_field('location');
                //$title = get_sub_field('description');
                //$description = get_sub_field('description');
            ?>
                <!--<div class="marker" data-lat="<?php # echo esc_attr($location['lat']); ?>" data-lng="<?php # echo esc_attr($location['lng']); ?>">
                     <h3><?php //echo esc_html( $title ); 
                                ?></h3>
                    <p><em><?php # echo esc_html($location['address']); ?></em></p>
                    <p><?php //echo esc_html( $description ); 
                            ?></p> -->
                </div>
            <?php #endwhile; ?>
        </div>
    <?php endif; ?>