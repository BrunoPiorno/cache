<?php if ($bag_logo = get_field('bag_logo','options')): ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>cart" class="site-cart">
        <img src="<?php echo $bag_logo['sizes']['large']; ?>" alt="img" />
        <div><span class="cart-header">CART (</span><?php
        global $woocommerce;
        $cart_subtotal = $woocommerce->cart->get_cart_subtotal();
        echo $cart_subtotal; ?><span class="cart-header"> )</span></div>
    </a>
<?php endif; ?>