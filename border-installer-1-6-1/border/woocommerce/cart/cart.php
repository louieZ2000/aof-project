<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post" class="cart-form">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-name" colspan="2"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
			<th class="product-remove">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php
		do_action( 'woocommerce_before_cart_contents' );

		get_template_part('woocommerce/cart/cart-loop');

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions">
				<?php if ( WC()->cart->coupons_enabled() ) { ?>
					<div class="coupon">

						<input name="coupon_code" class="input-text  push-half--right" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />

						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
				<?php } ?>
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>


<div class="cart-collaterals">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

	<?php woocommerce_cart_totals(); ?>

</div>

<div class="cart-submit-buttons cf  push--bottom">
	<?php if ( !wpgrade::option('use_ajax_loading') ) { ?>
		<input type="submit" class="button  push-half--right" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" />
	<?php } ?>
	<input type="submit" class="btn--primary  checkout-button button  alt wc-forward" name="proceed" value="<?php _e( 'Checkout', 'woocommerce' ); ?>" />

	<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	<?php wp_nonce_field( 'woocommerce-cart' ); ?>

	<a href="#" class="btn  btn--secondary  btn--small  shipping-calculator-button"><?php _e( 'Calculate Shipping', 'woocommerce' ); ?></a>
</div>

</form>

<?php woocommerce_shipping_calculator(); ?>

<?php do_action( 'woocommerce_after_cart' ); ?>

