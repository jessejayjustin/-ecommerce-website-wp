var $j = jQuery.noConflict();

$j(document).ready(function() {
	$j('.result-msg').hide();
	$j(document).on('click', '.add-to-bag', function(){
	  var action = "add";
	  var product_id = $j(this).attr("id");
	  var product_name = $j('#prod_name').val();
	  var product_price = $j('#prod_price').val();
	  var product_color = $j('#prod_color').val();
	  var product_size = $j('#prod_size').val();
	  var product_quantity = 1;
	  var prod_price = parseFloat(product_price.replace(/[^0-9.]/g, ''));
	    if(product_id != null)
	    {
			$j.ajax({
			    url:"http://localhost/wordpress/index.php/action/",
			    method:"POST",
			    data:{product_id:product_id, product_name:product_name, product_quantity:product_quantity, product_price:prod_price, product_color:product_color, product_size:product_size, action:action},
			    success:function(data)
			    {
			      if(data == true) 
			      {
                    $j('.result-msg').html("Item has been Added into Cart"); 
				    $j('.result-msg').show(); 
				    $j('.result-msg').addClass('alert-success'); 
			      } else {
			      	$j('.result-msg').html("err"); 
				    $j('.result-msg').show(); 
				    $j('.result-msg').addClass('alert-danger'); 
			      }
			    }
			});
			setTimeout(hideMsg, 4000);
	    }
		else
	    {
			alert("err");
	    }
	});	

	function hideMsg(){
	  $j('.result-msg').hide();
	}

	$j(".addQty").on("click", function(){
		var id = $j(this).attr("id");
		var quantity = $j(this).next();
		var qty = quantity.text();
		var q = parseInt(qty);
		quantity.text(++q);
		addPriceByQty(id, qty);
		totalPrice();
	});

	$j(".removeQty").on("click", function(){
		var id = $j(this).attr("id");
		var quantity = $j(this).prev();
		var qty = quantity.text();
		var q = parseInt(qty);
		var row = $j("table").find("[id='" + id + "']");
		var action = "remove";
		if(qty < 2) {
		    if(confirm("Are you sure you want to remove this product?")){
		    	row.remove();
                $j.ajax({
				    url:"http://localhost/wordpress/index.php/action/",
				    method:"POST",
				    data:{product_id:id, action:action},
				    success:function(data)
				    {
				      //console.log(data);
				    }
			    })
			    totalPrice();
			    emptyCheckoutSession(id);
			    emptyCheckoutPage(id);
			    window.location.reload();
                return false;
		    }
		    else
			{
			  return false;
			}
		} else {
		  quantity.text(--q);
		}
		subtractPriceByQty(id, qty);
		totalPrice();
	});

	function addPriceByQty(id, qty) {
      var cart_price_row = $j(".cart-price").find("[id='" + id + "']");
      var cart_price_span;
      var original_price;
      $j(cart_price_row).each(function(i,item){
	    if(i == 0) {
           cart_price_span = $j(item);
	    } else if(i == 1) {
           original_price = Number($j(item).val());
	    }
	  });
	  var cart_price = Number(cart_price_span.text());
      cart_price_span.html(parseFloat(original_price+cart_price).toFixed(2)); 
	}

	function subtractPriceByQty(id, qty) {
	    var cart_price_row = $j(".cart-price").find("[id='" + id + "']");
	    if(cart_price_row.length) {
	      var cart_price_span;
	      var original_price;
	      $j(cart_price_row).each(function(i,item){
		    if(i == 0) {
	           cart_price_span = $j(item);
		    } else if(i == 1) {
	           original_price = Number($j(item).val());
		    }
		  });
		  var cart_price = Number(cart_price_span.text());
	      cart_price_span.html(parseFloat(cart_price-original_price).toFixed(2));
        } 
	}

	function totalPrice() {
	    allrows = $j(".cart-price").find("span");
	    var total = 0;
		$j(allrows).each(function() {
		    total += parseFloat($j(this).text()) || 0;
		});
		if(!total == 0) {
          $j("#total_price").html("$"+total.toFixed(2));
        } else {
          $j("#total_price").html("$"+total.toFixed(2));
        }
		$j("#cart_total_price").val("$"+total.toFixed(2));

	}
	
	totalPrice();
    
	function emptyCheckoutSession(id) {
		var action = "empty";
        $j.ajax({
		    url:"http://localhost/wordpress/index.php/checkout-action/",
		    method:"POST",
		    data:{cart_id:id, action:action},
		    success:function(data)
		    {
		       //console.log(data);
		    }
	    })
	}

	function emptyCheckoutPage(id) {
		$j.ajax({
		   url:"http://localhost/wordpress/checkout/",
		   type:'GET',
		   success: function(data) {
		       var content = $j(data).find('table#table');
		       var row = content.find("[id='" + id + "']");
		       row.remove();
		   }
		});
	}

});
