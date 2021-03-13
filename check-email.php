<?php 

/* Template Name: check-email */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$jsemail = $_POST['jsemail'];

global $wpdb;
$query = "SELECT user_email FROM wp_users WHERE user_email = '$jsemail'";

$user_email = $wpdb->get_results($query);

foreach ($user_email as $user_emails ) {

	if( $user_emails == $jsemail) {
	   echo $jsemail;
	}else{
	   echo 'yes';
    }
}
?>