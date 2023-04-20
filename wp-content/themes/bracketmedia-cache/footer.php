<?php

/**

 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

if(!is_page_template('template-comming.php')): 

$footer_logo = get_field('footer_logo','options');
$stret_address = get_field('stret_address','options');
$email_address = get_field('email_address', 'options');
$patent = get_field('patent', 'options');
$tel = get_field('tel', 'options');
?>
			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="container">
					<div class="site-footer__cont">
						<div class="site-footer__cont__logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $footer_logo['sizes']['large']; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
						</div>	<!--/header__logo -->
						<div class="site-footer__cont__info">
							<?php wp_nav_menu( array('menu' => 'Menu Footer', 'menu_class' => 'site-footer__menu')); ?>
							
							<div class="info_cont">
								<?php if ($stret_address): ?>
									<p class="stret_address"><?php echo $stret_address ?></p>
								<?php endif; ?>
								<span>|</span>	
								<?php if ($email_address):?>
									<a href="mailto:" class="email_address"><?php echo $email_address; ?></a>
								<?php endif; ?>
								<span>|</span>	
								<?php if ($patent): ?>
									<p class="patent"><?php echo $patent; ?></p>
								<?php endif; ?>
								<span>|</span>	
								<?php if ($tel): ?>
									<p class="tel"><?php echo $tel; ?></p>
								<?php endif; ?>
							</div>
						</div>


						<div class="site-footer__cont__column">
							<div class="socials">
								<?php if (get_field('facebook','option')) { ?>
									<a href="<?php the_field('facebook','option') ?>" class="facebook" target="_blank"><?php get_template_part('icons/facebook'); ?></a>
								<?php }  ?>

								<?php if (get_field('twitter','option')) { ?>
									<a href="<?php the_field('twitter','option') ?>" class="twitter" target="_blank"><?php get_template_part('icons/twitter'); ?></a>
								<?php }  ?>

								<?php if (get_field('instagram','option')) { ?>
									<a href="<?php the_field('instagram','option') ?>" class="instagram" target="_blank"><?php get_template_part('icons/instagram'); ?></a>
								<?php }  ?>
							</div>	<!--/socials -->

							<?php if ($newsletter = get_field('newsletter','option')): ?>
								<div class="newsletter"><?php echo $newsletter; ?></div>
							<?php endif; ?>
									
							
							<a class="site-footer__cont__bracket" href="https://bracketmedia.com/" target="_blank"></a>
						</div>								

					</div>
				</div>
			</footer><!-- .site-footer -->
<?php endif; ?>

		</div><!-- .site-content -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
