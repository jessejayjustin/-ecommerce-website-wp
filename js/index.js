var $j = jQuery.noConflict();

$j(document).ready(function(){
    $j("#login_form").validate({
	  	rules: {
	  		username: {
		      required: true
	        },
		    password: {
	          required: true
	        }
	    },
	    messages: {
	        username: {
	            required: "username is required"
	        },
	        password: {
                required: "password is required"
            }
	    },
	    submitHandler: function (form, e) {
	    	e.preventDefault();
            
            $j('.indicator').html('Please wait...');
            $j('.indicator').show();
            $j('.result-message').hide();

		    var user = $j('#username').val();
		    var pass = $j('#password').val();
		    var sec = $j('#security').val();

		    // Data to send
		    data = {
		      'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
		      'username': user,
		      'password': pass,
		      'security': sec
		    };

	    	$j.ajax({
		    type: 'POST',
		    dataType: 'json',
		    url: ajax_login_object.ajaxurl,
		    data: data,
	        success:function(data){
	        	if(data) {
                  $j('.indicator').hide();
	        	}
		        if(data.loggedin == true) {
		          // If user is created
		          $j('.result-message').html(data.message); // Add success message to results div
		          $j('.result-message').addClass('alert-success'); // Add class success to results div
		          $j('.result-message').show(); // Show results div
		          document.location.href = 'http://localhost/wordpress/index.php/home';
		        } else {
		          $j('.result-message').html(data.message); // If there was an error, display it in results div
		          $j('.result-message').addClass('alert-danger'); // Add class failed to results div
		          $j('.result-message').show(); // Show results div
		        }
	        }
	        });
	    }
    });

  $j("#signin_form").validate({
  	rules: {
  		signin_user: {
	      required: true,
	      minlength: 8
        },
	    signin_mail: {
	      required: true,
	      email: true
	      /*
	      remote: {
            url: "http://localhost/wordpress/index.php/check_email/",
            type: "post"
          }
          */
	    },
	    signin_pass: {
          required: true
        }
    },
    messages: {
        signin_user: {
            required: "username is required",
            minlength: "username must be at least 8 characters"
        },
        signin_mail: {
            required: "email is required"
            //remote: "Email already in use!"
        },
        signin_pass: {
            required: "password is required"
        }
    },
    submitHandler: function (form, e) { 
            e.preventDefault();
            
            $j('.indicator').html('Please wait...');
            $j('.indicator').show();
            $j('.result-message').hide();

            var reg_nonce = $j('#signin_new_user_nonce').val();
		    var reg_user  = $j('#signin_user').val();
		    var reg_mail  = $j('#signin_mail').val();
		    var reg_pass  = $j('#signin_pass').val();

		     /**
		     * AJAX URL where to send data
		     * (from localize_script)
		     */
		    var ajax_url = signin_reg_vars.signin_ajax_url;

		    // Data to send
		    data = {
		      action: 'register_user',
		      nonce: reg_nonce,
		      user: reg_user,
		      mail: reg_mail,
		      pass: reg_pass,
		    };

            var form = $j(this);
            $j.ajax({
            type: "POST",
            dataType: 'json',
            url: ajax_url,
            data: data,
            success: function(data) {
                if(data) {
                  $j('.indicator').hide();
                }
          	    if(data.signin == true) {
		          $j('.result-message').html(data.message); // Add success message to results div
		          $j('.result-message').addClass('alert-success'); // Add class success to results div
		          $j('.result-message').show(); // Show results div
		          document.location.href = 'http://localhost/wordpress/';
		        } else {
		          $j('.result-message').html(data.message);
		          $j('.result-message').addClass('alert-danger'); // Add class failed to results div
		          $j('.result-message').show(); // Show results div
		        }
            }
            });      
        return false;
    }
  });
  $j("#forgot_pass_form").validate({
	  	rules: {
	  		usermail: {
		      required: true
	        }
	    },
	    messages: {
	        usermail: {
	            required: "Username/e-mail Shouldn't be empty"
	        }
	    }
  });
  $j("#reset_pass_form").validate({
	  	rules: {
	  		npass: {
		      required: true,
		      minlength: 6
	        },
		    cfpass: {
	          required: true,
	          minlength: 6
	        }
	    },
	    messages: {
	        npass: {
	            required: "New Password is required",
	            minlength: "Password must be at least 6 characters"
	        },
	        cfpass: {
                required: "Confirm Password is required",
                minlength: "Password must be at least 6 characters"
            }
	    }
  });
  // Check email exists
  $j("#prod-search").keyup(function() {
	var jsemail= $j("#signin_email").val();
	$j.ajax({
		url:"http://localhost/wordpress/index.php/search-product/",
		type:"POST",
		data:"action=chekmail&jsemail="+jsemail,
		success:function(results) {
			if(results=="yes"){
				$j("#err_mail").html("Sorry, that email address is already used!");
			} else {
				$j("#err_mail").html("The email is available");

			}
		}
    });
   });

  $j("#signin_username").keyup(function() {
	var jsuser= $j("#signin_username").val();
	$j.ajax({
		url:"http://localhost/wordpress/index.php/check-user/",
		type:"POST",
		data:"action=chekuser&jsuser="+jsuser,
		success:function(results) {
			if(results=="yes"){
				$j("#err_user").html("Sorry, that username is already used!");
			} else {
				$j("#err_user").html("The username is available");

			}
		}
    });
   });
    /*
    var timeout;
 
	jQuery( function( $ ) {
		$('.woocommerce').on('change', 'input.qty', function(){
	 
			if ( timeout !== undefined ) {
				clearTimeout( timeout );
			}
	 
			timeout = setTimeout(function() {
				$("[name='update_cart']").trigger("click");
			}, 500 ); // 1 second delay, half a second (500) seems comfortable too
	 
		});
	});
	*/
});
