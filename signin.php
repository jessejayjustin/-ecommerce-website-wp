<?php


get_header(); 

/* Template Name: signin */

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main"> 
		<div id="signin_banner">
			<div class="text-center result-message"></div>
			<div class="text-center alert-success indicator">Please wait...</div>
	        <form id="signin_form" method="post">
	       	  <div class="signin_form_header">
	       	  	<p>Xyz</p>
	       	  	<p>Market</p>
	       	  </div>
		      <p id="signin_text">Signin</p>
		      <p class="text-center status"></p>
		      <div class="signin_form_username">
	       	    <label for="signin_username">Username</label>
	       	    <input class="minlength required" id="signin_username" type="text" name="signin_username">
	       	    <div class="error" id="err_user"></div>
	       	  </div>
		      <div class="signin_form_email">
	       	    <label for="signin_email">Email</label>
	       	    <input class="required" id="signin_email" type="text" name="signin_email">
	       	    <div class="error" id="err_mail"></div>
	       	  </div>
	       	  <div class="signin_form_password">
	       	    <label for="signin_password">Password</label>
	       	    <input class="required" id="signin_password" type="password" name="signin_password">
	       	    <div class="error" id="err_pass"></div>
	       	  </div>
	       	  <?php wp_nonce_field('signin_new_user','signin_new_user_nonce', true, true ); ?>
	       	  <input type="submit" id="signin_btn" name="submit" value="Signin">
	          <div class="login_text">
	             <p>Already have an account? <a id="login_link" href="<?php echo home_url(); ?>">Login</a></p>
	          </div>
	        </form>
	    </div>

<?php
get_footer();