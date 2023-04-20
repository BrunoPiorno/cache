<section class="slider_brand">
    <div class="container">
        <?php if ($title = get_sub_field('title')): ?>
            <div class="slider_brand__title"><?php echo $title ?></div>
        <?php endif; ?>
        <?php if( have_rows('slider_brand') ): ?>
            <div class="slider_brand--cont">
                <?php while( have_rows('slider_brand') ): the_row(); 
                    $image = get_sub_field('image'); 
                    $link = get_sub_field('link');?>
                    <a href="<?php echo $link; ?>" class="slider_brand__image">
                        <img src="<?php echo $image['sizes']['large']; ?>" alt="img" />
                     </a>
                    
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>