<?php if( have_rows('truck_fit_guide') ): ?>

<div class="subnav__cont">
        <div class="section__subnav--select">
            <button><span class="text">Select Brand</span><span class="suit-icon icon--caret"></span></button>
        </div>
    <nav class="section__subnav">
        <div class="truck_guide__brands">
            <?php while( have_rows('truck_fit_guide') ): the_row(); 
            $brand = get_sub_field('brand'); ?>
                <div class="truck_guide__brands__title js-tab-title<?php echo get_row_index() ===  1 ? ' active':''; ?>" data-tab="brand<?php echo get_row_index();?>"><?php echo $brand; ?></div>
            <?php endwhile; ?>
        </div>
    </nav>
</div>

<?php endif; ?>

<?php if( have_rows('truck_fit_guide') ): ?>
    <div class="truck_guide__brands__cont">
        <?php while( have_rows('truck_fit_guide') ): the_row(); ?>
            <div class="truck_guide__brands__tab js-tab-content <?php echo get_row_index() ===  1 ? ' active':''; ?>" data-tab="brand<?php echo get_row_index();?>">
                <?php if( have_rows('trucks') ): ?>
                    <?php while( have_rows('trucks') ): the_row(); 
                        $model = get_sub_field('model');
                        $image = get_sub_field('image'); ?>
                        <div class="truck_guide__brands__models">
                            <div class="truck_guide__brands__models__left">
                                <?php if($image): ?>
                                    <div class="truck_guide__brands__models__image">
                                        <div class="image-background">
                                            <img src="<?php echo $image['sizes']['large']; ?>" alt="img"/>
                                        </div>
                                    </div>
                                 <?php endif; ?>
                            </div>

                            <div class="truck_guide__brands__models__right">
                                <?php if($model): ?>
                                    <div class="truck_guide__brands__models__right__title">
                                        <?php echo $model; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( have_rows('generation') ): ?>
                                    <div class="truck_guide__brands__models__options">
                                        <?php while( have_rows('generation') ): the_row(); 
                                        $title = get_sub_field('title');
                                        $year = get_sub_field('year');
                                        $fix = get_sub_field('fix');?>

                                            <div class="truck_guide__brands__models__option">
                                                <div class="truck_guide__brands__models__option__title"><?php echo $title; ?></div>
                                                <div class="truck_guide__brands__models__option__year"><?php echo $year; ?></div>
                                                <div class="fix--<?php echo $fix;?>"></div>
                                            </div>
                                            
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>