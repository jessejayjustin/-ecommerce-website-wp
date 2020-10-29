<?php 

get_header();

/* Template Name: forgot-pass-reset */

?>

<?php

if(isset($_POST['forgot_pass_Sbumit'])) {
  
	if (isset($_POST['usermail']) && empty($_POST['usermail'])) {
	 	$_SESSION['errors'] = array("Username/e-mail Shouldn't be empty");
	} else if(!filter_var($_POST['usermail'], FILTER_VALIDATE_EMAIL)) {
		$error .= 'Enter Valid Email ';
		$_SESSION['errors'] = array("Enter Valid Email");
	} else {
	 	$usermail = $_POST['usermail']; 
	 	$user_input = esc_sql(trim($usermail));
	}

	$errors = '';
	if(!empty($user_input)) {
	    if (strpos($user_input, '@')) {
		 	$user_data = get_user_by( 'email', $user_input); 
		 	if(empty($user_data) ) {
		 	   $errors .= "The email doesn't exist."; 
		 	   $_SESSION['errors'] = array("The email doesn't exist");
		 	} 
		} else {
			$user_data = get_user_by( 'login', $user_input); 
		 	if(empty($user_data) ) {
		 	   $errors .= "The username doesn't exist."; 
		 	   $_SESSION['errors'] = array("The username doesn't exist");
		 	} 
		}
	}

    if(empty($errors) && !empty($user_data)) {

    	$user_login = $user_data->user_login;
	    $user_email = $user_data->user_email;
        
    	function tg_validate_url() {
    		/*
			global $post;
			$page_url = home_url('reset-setting-password');
			$urlget = strpos($page_url, "?");
			if ($urlget === false) {
				$concate = "?";
			} else {
				$concate = "&";
			}
			*/
			return home_url('reset-setting-password');
        } 
        
		global $wpdb;
	
		$key = $wpdb->get_var("SELECT user_activation_key FROM $wpdb->users WHERE user_login ='".$user_login."'");
		
		 	if(empty($key)) {
		 	//generate reset key
				$key = wp_generate_password(20, false);
				$wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
			}
		 
			    $message = __('Someone requested that the password be reset for the following account:') . "<br><br><br>";
			 	$message .= get_option('siteurl') . "<br><br>";
			 	$message .= sprintf(__('Username: %s'), $user_login) . "<br>";
			 	$message .= __('If this was a error, just ignore this email as no action will be taken.') . "<br><br>";
			 	$message .= __('To reset your password, visit the following address:') . "<br><br>";
			 	$message .= '<a href="'. tg_validate_url() . "?action=reset_pwd&key=$key&login=" . rawurlencode($user_login) . '" > '. home_url('reset-setting-password') . "?action=reset_pwd&key=$key&login=" . rawurlencode($user_login) ."</a><br><br>";

			 	$subject = 'Password Reset'; 
		        
				$emailTo = get_option('tz_email');
				if (!isset($emailTo) || ($emailTo == '') ){
					$emailTo = get_option('admin_email');
				}
				$headers = 'From: '.$user_login.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $user_email;
				if(!wp_mail($user_email, $subject, $message, $headers)) {
		            $_SESSION['errors'] = array("Email failed to send");
				} else {
				    $_SESSION['success'] = array("We have just sent you an email with Password reset instructions");
				}
	} 
} else {
	if(empty($user_data)) {
	 	unset($user_data);
	}
}
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main"> 
		<div class="text-center result-message"></div>
		<?php if (isset($_SESSION['errors'])): ?>
			<div style="background-color: white" class="form-errors">
			    <?php foreach($_SESSION['errors'] as $error): ?>
			        <div class="text-center alert-danger"><?php echo $error ?></div>
			    <?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php if (isset($_SESSION['success'])): ?>
			<div style="background-color: white" class="form-success">
			    <?php foreach($_SESSION['success'] as $success): ?>
			        <div class="text-center alert-success"><?php echo $success ?></div>
			    <?php endforeach; ?>
			</div>
		<?php endif; ?>
		<div id="forgot_pass_banner">
	        <form id="forgot_pass_form" action="<?php echo "http://".$_SERVER["SERVER_NAME"].$_SERVER['REQUEST_URI']; ?>" method="post">
		      <div class="forgot_form_usermail">
		      	<div class="forgot_pass_header">
	       	  	  <p>Please enter your username or email address. You will receive an email message with instructions on how to reset your password.</p>
	       	    </div>
	       	    <label for="usermail">Username or Email Address</label>
	       	    <input class="required" id="usermail" type="text" name="usermail" value="">
	       	    <p class="text-center usermail-error"></p>
	       	    <p class="text-center username-error"></p>
	       	  </div>
	       	  <input type="hidden" name="forgot_pass_Sbumit" value="kv_yes" >
	       	  <input type="submit" id="forgot_pass_btn" name="submit" value="Get New Password">
	          <div class="log_in">
	            <a id="log_in_lnk" href="<?php echo home_url(); ?>">Log in</a> </p>
	          </div>
	        </form>
	    </div>
	</main>
</div>

<?php 
get_footer();






