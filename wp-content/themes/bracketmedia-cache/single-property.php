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
	<?php while ( have_posts() ) : the_post(); ?>
	<main id="main" class="site-main" role="main">
		
	</main><!-- .site-main -->
	<?php endwhile;	?>
</div><!-- .content-area -->

<?php get_footer(); ?>
