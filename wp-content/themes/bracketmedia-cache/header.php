<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $favicon = get_field('favicon','option');	?>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $favicon['url']; ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	<?php if ($header_property_script = get_field('header_property_script')): ?>
		<?php echo $header_property_script; ?>
	<?php endif; ?>
</head>
<?php
if(is_page()) {
	$parent = get_post($post->post_parent); 
	$page_slug = 'page-'.$post->post_name;
	if($parent): $parent_slug = 'parent-'.$parent->post_name; endif;
}
?>
<body <?php body_class($page_slug ." ". $parent_slug ." ". $class); ?>>
<?php
$site_logo = get_field('site_logo','options');
?>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<div class="site-inner">

		<header class="header">
			<div class="container">
				<div class="header__cont">
					<div class="header__cont__left">
						<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo $site_logo['sizes']['large']; ?>" alt="<?php bloginfo( 'name' ); ?>" alt="img" />
						</a>
					</div>

					<div class="header__cont__right">
						<?php get_template_part('modules/header/menu'); ?>
						<?php get_template_part('modules/header/cart'); ?>
					</div>							
				</div>	
			</div>
		</header>

<div id="content" class="site-content">
	
