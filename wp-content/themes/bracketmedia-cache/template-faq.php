<?php /* Template Name: Faq */ ?>
<?php get_header(); ?>
<?php
	if ( have_posts() ) : while ( have_posts() ) :
            the_post();
?>


<?php if( have_rows('faqs') ): ?>
    <div class="faqs">
        <div class="container">
        <div class="title_module" data-aos="zoom-in-right" ><?php echo the_title();?></div>
            <?php while( have_rows('faqs') ) : the_row();
                $faq_question = get_sub_field('faq_question');
                $faq_answer = get_sub_field('faq_answer'); ?>
                <div class="faqs__text__cont" data-aos="fade-up" data-aos-duration="1000">
                    <button class="faqs__text__cont--faqs"><?php echo $faq_question ?><i class="fas fa-plus"></i></button>
                    <div class="panel"><?php echo $faq_answer ?></div>
                </div>
            <?php endwhile; ?>

            <div class="faqs__item">
                <?php if ($video = get_field('video')): ?>
                    <div class="faqs__item__video" data-aos="fade-right" ><?php echo $video;?></div>
                <?php endif; ?>
                <div class="faqs__item__text-cont" data-aos="fade-left">	
                    <?php if ($title = get_field('title')): ?>
                        <div class="faqs__item__text-cont__title"><?php echo $title ?></div>
                    <?php endif; ?>
                    <?php if ($text = get_field('text')): ?>
                        <div class="faqs__item__text-cont__text"><?php echo $text ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>	

<?php
endwhile; endif;
?>

<?php get_footer(); ?>