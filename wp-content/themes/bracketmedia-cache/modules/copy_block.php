<?php if($copy_block = get_sub_field('copy_block')): ?>
<section class="copy_block" data-aos="fade-left">
    <div class="container">
        <?php if($title_module = get_sub_field('title_module')): ?>
            <div class="title_module" data-aos="zoom-in-right" ><?php echo $title_module; ?></div>
        <?php endif; ?>
        <div class="copy_block__cont"><?php echo $copy_block; ?></div>
    </div>
</section>
<?php endif; ?>