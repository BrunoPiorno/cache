<?php
$image = get_sub_field('image');
?>

<section class="home__hero">
    <div class="home__hero__image" data-aos="fade-left" data-aos-delay="100">
        <div class="image-background">
            <img src="<?php echo $image['sizes']['large']; ?>" alt="img" />
        </div>
    </div>
  
  <div class="home__hero__text-cont"  data-aos="flip-left" data-aos-delay="200">
    <?php if ($title = get_sub_field('title')): ?>
      <div class="home__hero__title"><?php echo $title; ?></div>
    <?php endif; ?>

    <?php if ($text = get_sub_field('text')): ?>
      <div class="home__hero__text"><?php echo $text; ?></div>
    <?php endif; ?>

    <?php if ($button = get_sub_field('button')): ?>
      <a class="home__hero__link" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
    <?php endif; ?>
  </div>
</section>