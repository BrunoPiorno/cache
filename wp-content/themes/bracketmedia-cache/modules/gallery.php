<?php $images = get_sub_field('gallery');
    if( $images ): ?>
    <section class="gallery" data-aos="fade-right">
        <div class="container">
            <div class="gallery__slider">
                <?php foreach( $images as $image ): ?>
                    <div class="gallery__slider__item">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" alt="img"/>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
