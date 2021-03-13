<?php 

/* Template Name: check-user */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$jsuser = $_POST['jsuser'];

global $wpdb;
$query = "SELECT user_login FROM wp_users WHERE user_login = '$jsuser'";

$users = $wpdb->get_results($query);

foreach ($users as $user ) {

	if( $user == $jsuser) {
	   echo $jsuser;
	}else{
	   echo 'yes';
    }
}
?>