<?php


get_header(); 

/* Template Name: signin */

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main"> 
		<div class="signin-banner">
			<div class="text-center result-message"></div>
			<div class="text-center alert-success indicator"></div>
	        <form id="signin_form" method="post">
	       	  <div class="signin-header">
	       	  	<p>Zack</p>
	       	  	<p>Market</p>
	       	  </div>
		      <p class="signin-text">Signin</p>
		      <p class="text-center status"></p>
		      <div class="signin-user">
	       	    <label for="signin_user">Username</label>
	       	    <input class="minlength required" id="signin_user" type="text" name="signin_user">
	       	    <div class="error" id="err_user"></div>
	       	  </div>
		      <div class="signin-mail">
	       	    <label for="signin_mail">Email</label>
	       	    <input class="required" id="signin_mail" type="text" name="signin_mail">
	       	    <div class="error" id="err_mail"></div>
	       	  </div>
	       	  <div class="signin-pass">
	       	    <label for="signin_pass">Password</label>
	       	    <input class="required" id="signin_pass" type="password" name="signin_pass">
	       	    <div class="error" id="err_pass"></div>
	       	  </div>
	       	  <?php wp_nonce_field('signin_new_user','signin_new_user_nonce', true, true ); ?>
	       	  <input type="submit" id="signin_btn" name="submit" value="Signin">
	          <div class="login-text-link">
	             <p>Already have an account? <a id="login_link" href="<?php echo home_url(); ?>">Login</a></p>
	          </div>
	        </form>
	    </div>

<?php
get_footer();