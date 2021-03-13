<?php 

get_header();

/* Template Name: cart */

include (TEMPLATEPATH . '/nav.php'); 

?>
<div class="table-responsive" id="order_table">
    <h2>Shopping Bag</h2>
	<table class="table table-bordered">
    <tr>  
        <th width="25%">Photos</th>  
        <th width="35%">Title</th> 
        <th width="22%">Qty</th>   
        <th width="5%">Price</th>  
    </tr>


<?php 

if(!empty($_SESSION["shopping_cart"]))
{
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{ 
    
    $id = $values['product_id'];
    $qty = $values["product_quantity"];
    $color = $values["product_color"];
    $size = $values["product_size"];

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
   
	<tr class="cart-row" id="<?php echo $id ?>">
	    <td class="cart-img" id="<?php echo $id ?>"><p><img src="<?= $thumb; ?>" /><p></td>
	    <td id="<?php echo $id ?>">
	    	<div class="cart-description">
	    	  <span><?= $title ?> - </span><br>
	    	  <span><?= $color ?> - <?= $size ?><span>
	    	</div>
	    </td>
	    <td class="cart-qty" id="<?php echo $id ?>">
	    	<div id="quantity">
				<input class="addQty btn" type="button" value="+" id="<?php echo $id ?>" />
				<span class="qty" id="<?php echo $id ?>"><?= $qty ?></span>
				<input class="removeQty btn" type="button" value="-" id="<?php echo $id ?>" />
		    </div>
		</td>
		<td class="cart-price" id="<?php echo $id ?>">
			<span id="<?php echo $id ?>"><?= $price * $qty ?></span>
			<input type="hidden" name="orginal-price" id="<?php echo $id ?>" value="<?php echo $price ?>">	
		</td>
    </tr>
    <div>
	    <input type="hidden" name="cart-size" id="cart_size" value="<?= $size; ?>" />
	    <input type="hidden" name="cart-total-price" id="cart_total_price" value="" />
	</div>
   
	<?php endwhile;
	endif; wp_reset_postdata();

    }
}

?>

    </table>
		<div class="total-price pull-right">
			<div class="total-price-child">
		 	   <span>Total:</span>
		    </div>
		    <div class="total-price-child">
		 	   <span id="total_price"></span>
		    </div><br>
		    <div class="total-price-btn pull-right">  
		 	  <input class="btn checkout" type="button" value="Checkout" />
		    </div>
		</div>
</div>

<?php 

get_footer();

?>
