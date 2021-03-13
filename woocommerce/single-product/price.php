<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
/*
function nt_product_attributes() {
global $product;
    if ( $product->has_attributes() ) {

        $attributes = ( object ) array (
        'sizes'  => $product->get_attribute( 'sizes' )
        );
    return $attributes;
    }
}

$attributes = nt_product_attributes();
echo $attributes->sizes;
*/
$id = $product->get_id();
$color = get_post_meta($id, '_color', true);
$thumb = get_the_post_thumbnail_url($id);

?>
<p class="product-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html() ?> CAD</p>

<p class="dotted"></p>

<p class="colour">colour:</p>
<p class="sp-color"><?php echo $color; ?></p>

<div class="sp-thumb">
  <img src="<?= $thumb; ?>" alt="sp-img" />
</div>

<p class="colour">sizes:</p>




 