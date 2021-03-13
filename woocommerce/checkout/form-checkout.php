<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}

include (TEMPLATEPATH . '.././nav.php'); 

do_action( 'woocommerce_before_checkout_form', $checkout );
// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">


	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
		<div class="checkout-fields" id="">

			<div class="woocommerce-form-coupon-toggle">
				<?php wc_print_notice( apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'woocommerce' ) . '</a>' ), 'notice' ); ?>
			</div>

			<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">

				<p><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?></p>

				<p class="form-row form-row-first">
					<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
				</p>

				<p class="form-row form-row-last">
					<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
				</p>

				<div class="clear"></div>
			</form>

			<div class="woocommerce-billing-fields">
				<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

					<h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

				<?php else : ?>

					<h3 style="color:#0000ff"><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></h3>

				<?php endif; ?>

				<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

				<div class="woocommerce-billing-fields__field-wrapper">
					<?php
					$fields = $checkout->get_checkout_fields( 'billing' );

					foreach ( $fields as $key => $field ) {
						woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
					}
					?>
				</div>

				<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
			</div>

			<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
				<div class="woocommerce-account-fields">
					<?php if ( ! $checkout->is_registration_required() ) : ?>

						<p class="form-row form-row-wide create-account">
							<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
								<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
							</label>
						</p>

					<?php endif; ?>

					<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

					<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

						<div class="create-account">
							<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
								<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
							<?php endforeach; ?>
							<div class="clear"></div>
						</div>

					<?php endif; ?>

					<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

			<?php

					do_action( 'woocommerce_before_checkout_form', $checkout );

			// If checkout registration is disabled and not logged in, the user cannot checkout.
			if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
				echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
				return;
			}

			?>

			<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

				<?php if ( $checkout->get_checkout_fields() ) : ?>

					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

					<div class="col2-set" id="customer_details">
						<div class="col-1">
							<?php do_action( 'woocommerce_checkout_billing' ); ?>
						</div>

						<div class="col-2">
							<?php do_action( 'woocommerce_checkout_shipping' ); ?>
						</div>
					</div>

					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<?php endif; ?>
				
				<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
				
				<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
				
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>

				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

			</form>

			<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
				</div>
			<?php endif; ?>

			<table class="shop_table woocommerce-checkout-review-order-table clearfix" id="checkout_table">
				<thead>
					<tr>
						<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
						<th class="product-total"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					do_action( 'woocommerce_review_order_before_cart_contents' );

					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							?>
							<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
								<td class="product-name">
									<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</td>
								<td class="product-total">
									<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</td>
							</tr>
							<?php
						}
					}

					do_action( 'woocommerce_review_order_after_cart_contents' );
					?>
				</tbody>
				<tfoot>

					<tr class="cart-subtotal">
						<th><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
						<td><?php wc_cart_totals_subtotal_html(); ?></td>
					</tr>

					<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
						<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
							<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
							<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
						</tr>
					<?php endforeach; ?>

					<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

						<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

						<?php wc_cart_totals_shipping_html(); ?>

						<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

					<?php endif; ?>

					<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
						<tr class="fee">
							<th><?php echo esc_html( $fee->name ); ?></th>
							<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
						</tr>
					<?php endforeach; ?>

					<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
						<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
							<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
								<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
									<th><?php echo esc_html( $tax->label ); ?></th>
									<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
								</tr>
							<?php endforeach; ?>
						<?php else : ?>
							<tr class="tax-total">
								<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
								<td><?php wc_cart_totals_taxes_total_html(); ?></td>
							</tr>
						<?php endif; ?>
					<?php endif; ?>

					<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

					<tr class="order-total">
						<th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
						<td><?php wc_cart_totals_order_total_html(); ?></td>
					</tr>

					<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

				</tfoot>
			</table>
            <div class="shop-total-bottom-border"></div>
			<div id="payment" class="woocommerce-checkout-payment">
				<?php if ( WC()->cart->needs_payment() ) : ?>
					<ul class="wc_payment_methods payment_methods methods">
						<?php
						if ( ! empty( $available_gateways ) ) {
							foreach ( $available_gateways as $gateway ) {
								wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
							}
						} else {
							echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
						}
						?>
					</ul>
				<?php endif; ?>
				<div class="form-row place-order">
					<noscript>
						<?php
						/* translators: $1 and $2 opening and closing emphasis tags respectively */
						printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
						?>
						<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
					</noscript>

					<?php wc_get_template( 'checkout/terms.php' ); ?>

					<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

					<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

					<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

					<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
				</div>
		    </div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>

    </div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<?php
if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}
?>
