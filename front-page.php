<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_starter_kit
 */

get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main"> 
		<div class="login-container">
			<div class="text-center result-message"></div>
			<div class="text-center alert-success indicator"></div>
	        <form id="login_form" method="post">
	       	  <div class="login-header">
	       	  	<p>Zack</p>
	       	  	<p>Market</p>
	       	  </div>
		      <p class="login-text">Login</p>
		      <div class="login-email">
	       	    <label for="username">Username</label>
	       	    <input class="required" id="username" type="text" name="username" value="">
	       	  </div>
	       	  <div class="login-pass">
	       	    <label for="password">Password</label>
	       	    <input class="required" id="password" type="password" name="password" value="">
	       	  </div>
	       	  <input type="submit" id="submit_btn" name="submit" value="Login">
	          <div class="signin-text-link">
	            <p>Don't you have an account? <a id="signin_link" href="<?php echo home_url('/signin/'); ?>">Signin</a> </p>
	            <p>Forgot Password? <a id="forgot_pass_link" href="<?php echo home_url('/forgot-pass/'); ?>">Click here</a> </p>
	          </div>
	          <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
	        </form>
	    </div>
	</main>
</div>

<?php 
get_footer();
		