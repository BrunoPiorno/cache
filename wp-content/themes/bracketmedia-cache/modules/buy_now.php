<section class="products-slider">
  <div class="container">
        <?php if($title_module = get_sub_field('title_module')): ?>
            <div class="title_module" data-aos="fade-right"><?php echo $title_module; ?></div>
        <?php endif; ?>
    <?php if (get_sub_field('title')) { ?>
      <div class="products-slider__top">
        <div class="products-slider__title"><?php the_sub_field('title'); ?></div>
      </div>
    <?php }  ?>
    <?php $featured_posts = get_sub_field('buy_now_products');
    if( $featured_posts ): ?>
      <div class="woocommerce" >
        <div class="products-slider__carousel"  data-aos="zoom-in-left" >

          <?php if( $featured_posts ): ?>
              <ul class="products">
                <?php foreach( $featured_posts as $post ): 
                  // Setup this post for WP functions (variable must be named $post).
                    setup_postdata($post);
                    get_template_part('woocommerce/content-product');
                  endforeach; ?>
              </ul>
              <?php wp_reset_postdata(); 
              endif; ?>

        </div>
      </div>
    <?php endif; ?>
  </div>
</section>