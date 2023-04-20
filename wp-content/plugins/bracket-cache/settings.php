<?php
    /*
    Plugin Name: Cache Functions
    Plugin URI:
    Description: 
    Author: Bruno Piorno
    Version: 1.0
    */
?>
<?php
    defined( 'ABSPATH' ) || die();
    if( isset($_GET['debug']) ):
        ini_set('display_errors',1);
        error_reporting(E_ALL);
    endif;

    add_action('wp_head',       function(){ the_field('analytics', 'option'); });
    add_action('wp_body_open',  function(){ the_field('analytics_body', 'option'); });
    add_action('wp_footer',     function(){ the_field('analytics_footer', 'option'); });


    /* VOTE REVIEW */
    add_action( 'wp_enqueue_scripts', 'review_enqueuer' );

    function review_enqueuer()
    {
        wp_register_script('review_cache',   plugin_dir_url(__FILE__)  . 'js/reviews.js', array( 'jquery' ));

        $scheme     =   is_ssl() ? 'https':'http';
        $params 	=	array(
                            'ajax_url'      =>  admin_url( 'admin-ajax.php', $scheme),
                            'nonce'         =>  wp_create_nonce( 'cache-nonce' ),
                        );
        wp_localize_script('review_cache', 'review_cache', $params);
        wp_enqueue_script( 'review_cache' );        
    }

    
    add_action( 'wp_ajax_nopriv_vote_review', 'vote_review' );
    add_action( 'wp_ajax_vote_review', 'vote_review' );
    
    function vote_review()
    {

        if( !wp_verify_nonce( $_POST['nonce'], 'cache-nonce' ) ):
            return 'Invalid nonce';
            exit;
        endif;

        // check that user is logged in
		if ( ! is_user_logged_in() )
        {
			wp_send_json( array(
                'status' => 'err', 
				'message' => __( 'You need to be logged in to vote.', 'woocommerce-product-reviews-pro' )
			) );
		}

        $comment_id = $_POST['comment_id'];
        $votetip    = $_POST['votetip'];

        // check that the request is valid
		if ( ! isset( $comment_id, $votetip ) )
        {
			wp_send_json( array(
                'status' => 'err', 
				'message' => __( 'Invalid request.', 'woocommerce-product-reviews-pro' )
			) );
		}


        $user_id = get_current_user_id();
        
        if (  has_user_voted($comment_id) ) 
        {
            wp_send_json( array(
                'status' => 'err', 
                'message' => __( 'You already voted on this comment!', 'woocommerce-product-reviews-pro' )
            ) );
        }



        $users_votes = get_users_votes($user_id);

        $users_votes[ $user_id ] = $votetip;


        $points = get_comment_meta($comment_id, $votetip, true );
        $points = $points + 1;

        $rslt = update_comment_meta( $comment_id, $votetip, $points);

        update_comment_meta( $comment_id, 'users_votes', $users_votes );

        $results     =   array(
            'status' => 'ok', 
            'content' => $rslt, 
            'points' => $points, 
            'message' => __( 'Vote has been cast. Thanks!', 'woocommerce-product-reviews-pro' )
        );

        wp_send_json($results);
        exit;
    }

    function get_users_votes($comment_id){
        $users_votes = get_comment_meta( $comment_id, 'users_votes', true );

		return ! empty( $users_votes ) && is_array( $users_votes ) ? $users_votes : array();
    }

    function has_user_voted($comment_id ) {

		return (bool) get_user_vote($comment_id);
	}

    function get_user_vote($comment_id) {

		$user_id = get_current_user_id();

		// Get all users' votes
		$users_votes = get_users_votes($comment_id);

		return isset( $users_votes[ $user_id ] ) ? $users_votes[ $user_id ] : null;
	}


    /* ///////////////// */

     // To change add to cart text on single product page
    add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
    function woocommerce_custom_single_add_to_cart_text() {
        return __( 'Buy Now', 'woocommerce' ); 
    }

    add_filter('woocommerce_product_related_products_heading',function(){
        return 'Other Proucts';
    });

    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

    function remove_wp_scripts()
    {
        if( is_admin() || ( $GLOBALS['pagenow'] === 'wp-login.php' ) ) return;
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'tiny_mce_plugins', function($plugins){ return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ):[];});
        add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
        wp_deregister_style('thickbox');
        wp_deregister_script('thickbox');
        wp_deregister_style('dashicons');
    }
    add_action('init', 'remove_wp_scripts');

    include('../cache-retails-partners/settings.php');

    add_action( 'woocommerce_before_calculate_totals', 'wc_auto_add_gift_to_cart' );

    // buy one, get one free
    function wc_auto_add_gift_to_cart( $cart ) {
    if (is_admin() && !defined('DOING_AJAX'))
        return;

	if( !get_field('enable_bogo','options')) return;
    
    $required_products_id = get_field('bogo_products','options'); // The required product Id (or variation Id)
    $parent_gift_id      = 0; // The parent variable product Id (gift) for a product variation (set to zero for simple products)
    $product_gift_id     = get_field('bogo_free','options'); // the variation Id or the product Id (gift)
    $has_required = $gift_key = false; // Initializing
    
    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
        // Check if required product is in cart
		foreach ($required_products_id as $required_product_id) {
			if( in_array( $required_product_id, array($cart_item['product_id'], $cart_item['variation_id']) ) ) {
			$has_required = true;
			}
			// Check if gifted product is already in cart
			if( $cart_item['data']->get_id() == $product_gift_id ) {
			$gift_key = $cart_item_key;
			}
		}
    }
    
    // If gift is in cart, but not the required product: Remove gift from cart
    if ( ! $has_required && $gift_key ) {
        $cart->remove_cart_item( $gift_key );
    }
    // If gift is not in cart and the required product is in cart: Add gift to cart
    elseif ( $has_required && ! $gift_key ) {
        // For simple products
        if( $parent_gift_id == 0 ) {
            $cart->add_to_cart( $product_gift_id);
        } 
        // For product variations (of a variable product)
        else {
            $cart->add_to_cart( $parent_gift_id, 1, $product_gift_id );
        }
    }
}
 ?>