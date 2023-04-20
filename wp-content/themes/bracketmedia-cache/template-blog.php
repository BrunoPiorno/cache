<?php /* Template Name: Blog */ ?>
<?php get_header(); ?>
<?php
	if ( have_posts() ) : 
        while ( have_posts() ) : the_post();
?>

            <section class="blog">
                <div class="container">
                    <div class="title-page" data-aos="zoom-in-right" ><?php the_title();?></div>
                    <div class="blog__grid">
                        <?php 
                        $args = array( 
                            'posts_per_page' => -1, 
                            'orderby'=> 'title', 
                            'order' => 'ASC' 
                        );
                            $query = new WP_Query($args);
                            while( $query->have_posts() ): $query->the_post(); ?>
                                
                                    <div class="blog__grid__item" data-aos="zoom-in-up" >
                                        <div class="blog__image">
                                            <div class="image-background">
                                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
                                            </div>

                                            <div class="blog__image__overlay">
                                                <a href="<?php the_permalink(); ?>"><?php get_template_part('/icons/more'); ?></a>
                                            </div>
                                            
                                        </div>
                                        <div class="blog__date"><a href="<?php the_permalink(); ?>"><?php the_date(); ?></a></div>
                                        <div class="blog__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                        <div class="blog__text"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_content(), 40, '...' ); ?></a></div>
                                    </div>
                        <?php 
                            endwhile;
                            wp_pagenavi(['query' => $query]);
                            wp_reset_postdata();
                        ?>
                    </div>
                </div>                
            </section>
            <?php wp_reset_postdata();?>
            
<?php
endwhile; endif;
?>

<?php get_footer(); ?>