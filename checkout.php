<?php 

get_header();

/* Template Name: checout */

include (TEMPLATEPATH . '/nav.php'); 

?>

<?php global $current_user;
      get_currentuserinfo();
      /*
      echo 'Username: ' . $current_user->user_login . "
";
      echo 'User email: ' . $current_user->user_email . "
";
      echo 'User first name: ' . $current_user->user_firstname . "
";
      echo 'User last name: ' . $current_user->user_lastname . "
";
      echo 'User display name: ' . $current_user->display_name . "
";
      echo 'User ID: ' . $current_user->ID . "
";
*/
?>

<div class="table-responsive" id="checkout_table">
    <h2>Checkout</h2>
    <p>Hi <span><?php echo $current_user->user_login ?></span> Please review your items and press
    the confirm checkout <br> button. You will enter your address information while your paying
    on <br>Stripe.
    </p> 
    <div class="border-bottom-container">
    	<div class="border-bottom"></div>
    </div>
	<table class="table table-condensed" id="table">
    <tr>  
        <th></th>  
        <th></th> 
        <th></th> 
    </tr>

<?php 

if(!empty($_SESSION["checkout_cart"]))
{
	foreach($_SESSION["checkout_cart"] as $keys => $values)
	{ 
	    $id = $values["cart_id"];
	    $qty = $values["cart_qty"];
	    $total_price = $values['total_price'];
	   
		$args = array(
		    'post_type' => 'products',
		    'posts_per_page' => -1,
		    'order' => 'ASC',
		    'p' => $id
		);

		$query = new WP_Query($args);

		if($query->have_posts()) : 
		    
	    while($query->have_posts()) : $query->the_post();

	    $product_id = get_the_ID();
	  
	    $url = get_the_permalink();
	    $title = get_the_title();
	    $thumb = get_the_post_thumbnail_url();
	    $price_meta = get_post_meta($id,'price',true);
	    $color = get_post_meta($id,'color',true);
	    $price = preg_replace("/[^0-9\.]/", '', $price_meta);

		?>
	   
		<tr class="cart-checkout-row" id="<?php echo $id ?>">
		    <td class="cart-checkout-img" id="<?php echo $id ?>">
		    	<p><img src="<?= $thumb; ?>" /><p><br>
		    </td>
		    <td id="<?php echo $id ?>">
		    	<div class="cart-checkout-name">
		    	  <span><?= $title ?> - <?= $color ?></span>
		    	</div>
		    </td>
			<td class="cart-checkout-price" id="<?php echo $id ?>">
				<span>$<?= $price ?> X <?= $qty ?></span>
				<input type="hidden" name="cart-price" value="<?php echo $price ?>">	
			</td>
	    </tr>
	   
		<?php endwhile;
		endif; wp_reset_postdata();
    }  
} 

?>
    </table>
    <div class="border-top-container">
    	<div class="border-top"></div>
    </div>
    <div class="total-section clearfix">
		<div class="subtotal">
			<div class="subtotal-child">
		 	   <span>Subtotal</span>
		    </div>
		    <div class="subtotal-child pull-right">
		 	   <span><?= $total_price ?></span>
		    </div>
		</div>
		<div></div><br>
		<div class="shipping">
			<div class="shipping-child">
		 	   <span>Shipping</span>
		    </div>
		    <div class="shipping-child pull-right">
		 	   <span>Free</span>
		    </div>
		</div><br>
        <div class="taxes">
			<div class="taxes-child">
		 	   <span>Taxes</span>
		    </div>
		    <div class="taxes-child pull-right">
		 	   <span>Free</span>
		    </div>
		</div><br>
		<div class="total">
			<div class="total-child">
		 	   <span>Total</span>
		    </div>
		    <div class="total-child pull-right">
		 	   <span><?= $total_price ?></span>
		    </div>
		</div><br><br>
		<div id="total_border_bottom"></div>
	    <div class="confirm-checkout-btn pull-right">  
	 	  <input class="btn confirm-checkout-button" type="button" value="confirm checkout" />
	    </div>
    </div>

</div>


<?php 

get_footer();

?>
