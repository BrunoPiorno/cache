<?php /* Template Name: Pages */ ?>
<?php get_header(); ?>
<?php
	if ( have_posts() ) : 
        while ( have_posts() ) : the_post();
?>
        <div class="title_module" data-aos="zoom-in-right" ><?php echo the_title(); ?></div>
        <?php 
            if( post_password_required() ):
                the_content();
            else:
                if( have_rows('blocks') ):
        ?>
                <section class="about-blocks">
                    <div class="container" data-aos="zoom-in" >
                    <?php while ( have_rows('blocks') ) : the_row(); ?>
                        <div class="about-blocks__item">
                                <?php if ($title = get_sub_field('title')): ?>
                                    <div class="about-blocks__item__title--mobile"><?php echo $title ?></div>
                                <?php endif; ?>
                                <?php if ($image = get_sub_field('image')): ?>
                                    <div class="about-blocks__item__image">
                                        <div class="image-background">
                                            <img src="<?php echo $image['sizes']['large']; ?>" alt="img" />
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="about-blocks__item__text-cont">	
                                    <?php if ($title = get_sub_field('title')): ?>
                                        <div class="about-blocks__item__title"><?php echo $title ?></div>
                                    <?php endif; ?>
                                    <?php if ($text = get_sub_field('text')): ?>
                                        <div class="about-blocks__item__text"><?php echo $text ?></div>
                                    <?php endif; ?>
                                </div>
                        </div>
                    <?php endwhile; ?>
                    </div>
                </section>
<?php
                endif; // have rows
            endif;  // endif password required
        endwhile; 
    endif;
?>
<?php get_footer(); ?>