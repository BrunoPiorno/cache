<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$fitguide = get_field('truck_fit_guide');
?>
<section id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<section class="product__single">
		<div class="container">
			<div class="product__single__top">
				<div class="product__single__top__left" data-aos="fade-right">
					<?php
					/**
					 * Hook: woocommerce_before_single_product_summary.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
					?>
				</div>

				<div class="product__single__top__right" data-aos="fade-left">
					<?php if ( $product->get_sku() ) {
					echo '<span class="sku_wrapper">Cod: '. $product->get_sku() .'</span>';
					} ?>

					<?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );
					?>

					<?php $title = get_field('title'); ?>
					<?php $field = get_field_object('dimensions'); ?>
					<?php if( have_rows('dimensions') ): ?>
					<div class="dimensions_title"><?php echo $field['label']; ?></div>
						<div class="product__single__top__right__dimensions">
						<?php while( have_rows('dimensions') ): the_row(); 
							$title = get_sub_field('title');
							$text = get_sub_field('text');
							?>
							<div class="dimensions_flex">
								<div class="title_dimensions"><?php echo $title; ?></div>
								<div class="text_dimensions"><?php echo $text; ?></div>
							</div>				
						<?php endwhile; ?>
						</div>
					<?php endif; ?>

					<div class="button_anchor" onClick="jQuery('.product-tabs').scrollTo(60);">DOES IT FIT MY TRUCK?</div>
				</div>
			</div>


		<?php get_template_part('modules/features');?>


			<section class="product-tabs">
				<div class="container">
					<?php $return_warranty_policy = get_field('return_warranty_policy');
					$product_video = get_field('product_video');
					$tab_index=0;?>

					<div class="subnav__cont">
						<div class="section__subnav--select">
							<button><span class="text">Jump To</span><span class="suit-icon icon--caret"></span></button>
						</div>
						<nav class="section__subnav">
						
							<div class="product-tabs__titles">
								<?php 
								
								if($fitguide):
								?>
									<div class="product-tabs__title js-tab-title active" data-tab="<?php echo $tab_index++; ?>">Truck Fit Guide</div>
								<?php endif;?>

								<?php if($product_video): ?>
									<div class="product-tabs__title js-tab-title<?php echo $tab_index ? '':' active';?>" data-tab="<?php echo $tab_index++; ?>">PRODUCT VIDEO</div>
								<?php endif; ?>

								<div id="reviews" class="product-tabs__title js-tab-title<?php echo $tab_index ? '':' active';?>" data-tab="<?php echo $tab_index++; ?>">Reviews</div>
								<div class="product-tabs__title js-tab-title" data-tab="<?php echo $tab_index++; ?>">Questions</div>
								<?php if($return_warranty_policy): ?>
									<div class="product-tabs__title js-tab-title" data-tab="<?php echo $tab_index++; ?>">Return & Warranty Policy</div>
								<?php endif; ?>
							</div>
						</nav>
					</div>
					<div class="product-tabs__wrapper">
					<?php $tab_index=0;?>
					<?php 
					if( $fitguide ): ?>
							<div class="product-tabs__tab js-tab-content" data-tab="<?php echo $tab_index++; ?>">
								<div class="product-tabs__line">
									<?php get_template_part('modules/truck-fix-guide'); ?>
								</div>					
							</div>
					<?php endif;?>

					<?php if($product_video): ?>
							<div class="product-tabs__tab product-tabs__tab--video js-tab-content" data-tab="<?php echo $tab_index++; ?>">
								<div class="product-tabs__line">
									<?php echo $product_video; ?>
								</div>
							</div>
					<?php endif; ?>

					<?php
                    ?>
					<div class="product-tabs__tab product-tabs__tab--review js-tab-content" data-tab="<?php echo $tab_index++; ?>">
						<div class="product-tabs__line">
						<?php wc_get_template( 'single-product/form-contribution.php', array( 'type' => 'review') ); ?>
                            <?php //comments_template(); ?>
							<div id="contributions-list">
                                <?php
                                $args = array(
                                    'post_id'   =>  $product->get_id(),  // Product Id
                                    'type'      =>  'review'  ,
                                    'status'    =>  'approve'   
                                );
                                $comments = get_comments($args);

                                ob_start();
                                comments_template( '', true );
                                ob_end_clean();/*

                                var_dump($comments);
                                $filters        = wc_product_reviews_pro_get_current_comment_filters();
                                $current_type   = isset( $filters['comment_type'] ) ? $filters['comment_type'] : null;
                                $current_rating = isset( $filters['rating'] ) ? $filters['rating'] : null;
                                
                                wc_get_template( 'single-product/contributions-list.php', array(
                                    'comments'       => $comments,
                                    'current_type'   => 'review',
                                    'current_rating' => $current_rating,
                                ) );*/

                                ?>
								<?php //comments_template( 'single-product/contributions.php');   ?>
                                <?php //wc_get_template( 'single-product/contributions.php');   ?>
                                <?php wc_get_template( 'single-product/contributions-list.php', array( 'comments' => $comments, 'current_type' => 'review' ) ); ?>
							</div>
							<?php /* $comments = wc_product_reviews_pro_get_contribution(); */?>
						</div>
					</div>

					<div class="product-tabs__tab product-tabs__tab--question js-tab-content" data-tab="<?php echo $tab_index++; ?>">
						<div class="product-tabs__line">
						<?php wc_get_template( 'single-product/form-contribution.php', array( 'type' => 'question' ) ); ?>
							<div id="contributions-list">
                                <?php
                                $args = array(
                                    'post_id'   =>  $product->get_id(),  // Product Id
                                    'type'      =>  array('question','contribution_comment') ,
                                    'status'    =>  'approve'   
                                );
                                $comments = get_comments($args);

                                ob_start();
                                comments_template( '', true );
                                ob_end_clean();
                                
                                wc_get_template( 'single-product/contributions-list.php', array( 'comments' => $comments, 'current_type' => 'question' ) );
                                
                                ?>
							</div>
						</div>
					</div>

					<?php if($return_warranty_policy): ?>
						<div class="product-tabs__tab product-tabs__tab--return js-tab-content" data-tab="<?php echo $tab_index++; ?>">
							<div class="product-tabs__line">
								<?php echo $return_warranty_policy; ?>
							</div>
						</div>
					<?php endif; ?>
					</div>
				</div>
			</section>


			<div class="product__single__bottom">
			<?php if( have_rows('banner_slider') ):?>
				<section class="banner_slider">
					<div class="container">
						<div class="banner_slider__carousel">
							<?php while ( have_rows('banner_slider') ): the_row(); ?>
								<div>
									<div class="banner_slider__item">
										<div class="banner_slider__item__left" >
											<?php if($image = get_sub_field('image')): ?>
												<div class="banner_slider__item__image">
													<div class="image-background">
														<img src="<?php echo $image['sizes']['large']; ?>" />
													</div>
												</div>
											<?php endif; ?>
										</div>
										
										<div class="banner_slider__item__right">
											<div class="banner_slider__item__cont">
												<?php if($title = get_sub_field('title')): ?>
													<div class="banner_slider__item__cont__title"><?php echo $title; ?></div>
												<?php endif; ?>

												<?php if($text = get_sub_field('text')): ?>
													<div class="banner_slider__item__cont__text"><?php echo $text; ?></div>
												<?php endif; ?>
											</div>
										</div>

									</div>
								</div>          
							<?php endwhile; ?>
						</div>
					</div>
				</section>
				<?php endif; ?>
				<?php woocommerce_output_related_products();?>
			</div>
		</div>
	</section>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
