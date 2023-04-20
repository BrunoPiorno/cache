<section class="image-text">
	<div class="container">
        <div class="title_module" data-aos="zoom-in-right"  ><?php echo the_title(); ?></div>
		<div class="image-text__item" data-aos="fade-right">
            <?php if ($title = get_sub_field('title')): ?>
                <div class="image-text__item__title--mobile"><?php echo $title ?></div>
            <?php endif; ?>
            <?php if ($image = get_sub_field('image')): ?>
                <div class="image-text__item__image">
                    <div class="image-background">
                        <img src="<?php echo $image['sizes']['large']; ?>" alt="img" />
                    </div>
                </div>
            <?php endif; ?>
            <div class="image-text__item__text-cont">	
                <?php if ($title = get_sub_field('title')): ?>
                    <div class="image-text__item__title"><?php echo $title ?></div>
                <?php endif; ?>
                <?php if ($text = get_sub_field('text')): ?>
                    <div class="image-text__item__text"><?php echo $text ?></div>
                <?php endif; ?>
            </div>
		</div>
	</div>
</section>