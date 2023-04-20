<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<section class="news-single">
			<div class="container">
				<div class="title_module" data-aos="zoom-in-right" >BLOG</div>
				<div class="news-single__cont">
					<div class="news-single__left" data-aos="fade-right" >
						<div class="blog__date"><?php the_date(); ?></div>
						<div class="news-single__title"><?php the_title(); ?></div>
						<div class="news-single__image">
							<div class="image-background">
								<?php the_post_thumbnail(); ?>
							</div>
						</div>
					</div>

					<div class="news-single__right" data-aos="fade-left" >
						<div class="news-single__right__text"><?php the_content(); ?></div>
					</div>
				</div>
			</div>
			
	<?php endwhile;	?>
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php get_footer(); ?>
