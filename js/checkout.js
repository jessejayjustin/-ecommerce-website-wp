var $j = jQuery.noConflict();

$j(document).ready(function() {
	$j(document).on('click', '.checkout', function(){
	  var cart_id = new Array();
	  var cart_qty = new Array();
	  $j('table .cart-row').each(function() {
	    cart_id.push(this.id);
	    var qty = $j(this).find("[class='qty']");
	    cart_qty.push(qty.text());
	  });
	  total_price = $j("#cart_total_price").val();
	  var action = "checkout";
	    if(cart_id)
	    {
			$j.ajax({
			    url:"http://localhost/wordpress/index.php/checkout-action/",
			    method:"POST",
			    data:{cart_id:cart_id, cart_qty:cart_qty, total_price:total_price, action:action},
			    success:function(data)
			    {
			      if(data != null) {
			      	window.location.replace('http://localhost/wordpress/checkout/');
			      } else {
			      	console.log(data);
			      }
			    }
			});
	    }
		else
	    {
			alert("err");
	    }
	});	

	

});