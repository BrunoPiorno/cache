<?php $position = get_sub_field('position');
$link = get_sub_field('link');?>
<section class="banner banner--<?php echo $position; ?>" data-aos="fade-right" data-aos-offset="-400">
    <div class="container">
        <a href="<?php echo $link; ?>" class="banner__cont">
            <div class="banner__cont__left">
                <?php $image = get_sub_field('image'); 
                if ($image): ?>
                    <div class="banner__image">
                        <div class="image-background">
                            <img src="<?php echo $image['sizes']['large']; ?>" alt="img"/>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="banner__cont__right">
                <div class="banner__text-cont">
                    
                    <?php if($title = get_sub_field('title')): ?>
                        <div class="banner__title"><?php echo $title; ?></div>
                    <?php endif; ?>

                    <div class="banner--arrow"></div>

                    <?php if($text = get_sub_field('text')): ?>
                        <div class="banner__text"><?php echo $text; ?></div>
                    <?php endif; ?>
                </div>
            </div>       
        </a>
    </div>
</section>