<?php 

/* Template Name: check-email */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$email = $_POST['email'];

global $wpdb;
$query = "SELECT user_email FROM wp_users WHERE user_email = '$email'";

$mail = $wpdb->get_results($query);

if($mail) {
   echo 'email is already used!';
}else{
   echo 'email is available';
}

?>