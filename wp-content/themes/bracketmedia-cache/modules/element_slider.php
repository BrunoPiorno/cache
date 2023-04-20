<?php if( have_rows('slider') ):?>
<section class="element_slider" data-aos="flip-up">
	<div class="container">
        <div class="element_slider__carousel">
            <?php while ( have_rows('slider') ) : the_row(); ?>
                <div>
                    <div class="element_slider__item">
                        <?php if($image = get_sub_field('image')): ?>
                            <div class="element_slider__item__image">
                                <img src="<?php echo $image['sizes']['large']; ?>" alt="img" />
                                <?php if( have_rows('dots') ):?>
                                    <?php while ( have_rows('dots') ) : the_row(); ?>
                                    <?php $top_position = get_sub_field('top_position'); 
                                    $left_position = get_sub_field('left_position'); ?>
                                
                                    <div class="element_slider__item__dot" style="top: <?php echo $top_position; ?>%; left: <?php echo $left_position; ?>%; ">
                                        <div class="dot js-open-popup" data-popup="<?php echo get_row_index(); ?>"></div>
                                        <div class="element_slider__item__dot__product">
                                        <a href="javascript:void(0)" class="close_popup--responsive"></a>
                                        <?php
                                            $product = get_sub_field('product');
                                            if( $product ): 
                                                global $post;
                                                $post = $product;
                                                $post_id = get_the_ID();
                                                setup_postdata( $post ); ?>
                                                    <a class="image-product" href="<?php the_permalink(); ?>">
                                                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );?>
                                                        <img src="<?php echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>" alt="img">
                                                        <div class="element_slider__item__dot__product__cont">
                                                            <div class="product_title"><?php the_title(); ?></div>
                                                            <?php $product = wc_get_product( $post_id );?>
                                                            <div class="product_price">$<?php echo $product->get_price(); ?>
                                                                <?php $free_shipping = get_field('free_shipping');
                                                                if($free_shipping): ?>
                                                                    <div class="free_shipping">+ FREE SHIPPING</div>    
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>                                      
                                                        <div class="product_text"><?php the_excerpt(); ?></div>
                                                    </a>                                        
                                                <?php wp_reset_postdata(); 
                                            endif; ?>
                                        </div>
                                    </div>

                                    <?php endwhile; ?>
                                <?php endif; ?>     
                            </div>
                        <?php endif; ?>                                       
                    </div>
                </div>          
             <?php endwhile; ?>
        </div>
	</div>
</section>
<?php endif; ?>