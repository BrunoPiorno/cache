<section class="contact">
    <div class="container">
        <div class="title_module" data-aos="zoom-in-right" ><?php the_title(); ?></div>
        <div class="contact__cont">
            <?php if($text = get_sub_field('text')): ?>
                <div class="contact_copy" data-aos="fade-right" >
                    <div class="copy"><?php echo $text; ?></div>
                </div>
            <?php endif; ?>

            <?php if($contact = get_sub_field('contact')): ?>
                <div class="contact_form" data-aos="fade-left"  ><?php echo $contact; ?></div>
            <?php endif; ?>
        </div>
    </div>
</section>