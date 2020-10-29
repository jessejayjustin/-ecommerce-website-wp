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
	            required: "Username is required"
	        },
	        password: {
                required: "Password is required"
            }
	    },
	    submitHandler: function (form, e) {
	    	e.preventDefault();

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
		          document.location.href = 'http://localhost/wordpress/index.php/home-page';
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
  		signin_username: {
	      required: true,
	      minlength: 8
        },
	    signin_email: {
	      required: true,
	      email: true
	      /*
	      remote: {
            url: "http://localhost/wordpress/index.php/check_email/",
            type: "post"
          }
          */
	    },
	    signin_password: {
          required: true
        }
    },
    messages: {
        signin_username: {
            required: "Username is required",
            minlength: "Username must be at least 8 characters"
        },
        signin_email: {
            required: "Email is required"
            //remote: "Email already in use!"
        },
        signin_password: {
            required: "Password is required"
        }
    },
    submitHandler: function (form, e) { 
            e.preventDefault();

            $j('.indicator').show();
            $j('.result-message').hide();

            var reg_nonce = $j('#signin_new_user_nonce').val();
		    var reg_user  = $j('#signin_username').val();
		    var reg_mail  = $j('#signin_email').val();
		    var reg_pass  = $j('#signin_password').val();

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
            url: ajax_url,
            data: data,
            success: function(data) {
                if(data) {
                  $j('.indicator').hide();
                }
          	    if(data === '1') {
		          $j('.result-message').html('Your submission is complete.'); // Add success message to results div
		          $j('.result-message').addClass('alert-success'); // Add class success to results div
		          $j('.result-message').show(); // Show results div
		          document.location.href = 'http://localhost/wordpress';
		        } else {
		          if(data === 'Sorry, that email address is already used!') {
		          	$j('#err_mail').html(data);
		          } else {
                    $j('.result-message').html(data);
		          }
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
  $j("#signin_email").keyup(function() {
	var jsemail= $j("#signin_email").val();
	$j.ajax({
		url:"http://localhost/wordpress/index.php/check_email/",
		type:"POST",
		data:"action=chekmail&jsemail="+jsemail,
		success:function(results) {
			if(results=="yes"){
				$j("#err_mail").html("Sorry, that email address is already used!");
			} else {
				$j("#err_mail").html("The email doesn't exist");

			}
		}
    });
   });

  $j("#signin_username").keyup(function() {
	var jsuser= $j("#signin_username").val();
	$j.ajax({
		url:"http://localhost/wordpress/index.php/check_user/",
		type:"POST",
		data:"action=chekuser&jsuser="+jsuser,
		success:function(results) {
			if(results=="yes"){
				$j("#err_user").html("Sorry, that username is already used!");
			} else {
				$j("#err_user").html("The username doesn't exist");

			}
		}
    });
   });
});
