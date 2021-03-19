<?php 

/* Template Name: check-user */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$username = $_POST['username'];

global $wpdb;
$query = "SELECT user_login FROM wp_users WHERE user_login = '$username'";

$user = $wpdb->get_results($query);

if($user) {
   echo 'username is already used!';
}else{
   echo 'username is available';
}

?>