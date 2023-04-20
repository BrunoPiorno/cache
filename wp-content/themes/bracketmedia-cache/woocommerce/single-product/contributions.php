<?php
/**
 * WooCommerce Product Reviews Pro
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Product Reviews Pro to newer
 * versions in the future. If you wish to customize WooCommerce Product Reviews Pro for your
 * needs please refer to http://docs.woocommerce.com/document/woocommerce-product-reviews-pro/ for more information.
 *
 * @author    SkyVerge
 * @copyright Copyright (c) 2015-2019, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

defined( 'ABSPATH' ) or exit;

/**
 * Display single product reviews (comments).
 *
 * @type string $type Contribution type.
 * @type \WC_Product $product Product object.
 * @type \WP_Comment[] $comments Array of comment objects.
 *
 * @version 1.13.0
 * @since 1.0.0
 */

global $product;

if ( ! comments_open() ) {
	return;
}

$contribution_types = wc_product_reviews_pro_get_enabled_contribution_types();
$ratings            = array( 5, 4, 3, 2, 1 );
$total_rating_count = $product->get_rating_count();

$filter = wc_product_reviews_pro_get_contribution_type('review');

var_dump(wc_product_reviews_pro_get_current_comment_filters());
?>
<div id="reviews">
	

	<?php
	/**
     * Fires before contribution list and title
     *
     * @since 1.0.1
	 */
	do_action( 'wc_product_reviews_pro_before_contributions' );

	?>


	<?php $key = 0; 
    
    ?>
	
    <div id="contributions-list">
        <?php wc_get_template( 'single-product/contributions-list.php', array( 'comments' => $comments, 'current_type' => 'question' )); ?>
    </div>
	
	<div class="clear"></div>
</div>
