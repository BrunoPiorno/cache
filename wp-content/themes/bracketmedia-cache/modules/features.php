<?php $field = get_field_object('features'); ?>
    <?php if ($feature_image = get_field('feature_image')): ?>
            <?php if($field): ?>
        <section class="features">
            <div class="container">
                <div class="features__title"><?php echo $field['label']; ?></div>
                <div class="features__cont">
                    <div class="features__image">
                            <img src="<?php echo $feature_image['sizes']['large']; ?>" alt="img" />
                        <?php if($field = get_field_object('features')):?>
                            <?php if( have_rows('features') ): ?>
                                <?php $i = 0;
                                while( have_rows('features') ): the_row(); 
                                    $title = get_sub_field('title');
                                    $text = get_sub_field('text');
                                    $top_position = get_sub_field('top_position'); 
                                    $left_position = get_sub_field('left_position'); 
                                    $i++;?>

                                    <div class="features__cont__dot" style="top: <?php echo $top_position; ?>%; left: <?php echo $left_position; ?>%; ">
                                        <span class="dot js-open-pop-up"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></span>
                                    </div>

                                    <div class="features__content">
                                        <div class="features__cont__item">
                                            <a href="javascript:void(0)" class="close_popup"></a>
                                            <span class="dot"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></span>
                                            <div class="title"><?php echo $title; ?></div>
                                            <div class="text"><?php echo $text; ?></div>
                                        </div>
                                        <?php if($video = get_sub_field('video')): ?>
                                            <div class="features__video"><?php echo $video; ?></div>
                                        <?php endif; ?>
                                    </div>
                                <?php endwhile; ?> 
                            <?php endif; ?>      
                        <?php endif; ?>    
                    </div>
                </div>            
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
