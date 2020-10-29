<?php 

get_header();

/* Template Name: home-page */

?>

<?php global $current_user;
      get_currentuserinfo();
      /*
      echo 'Username: ' . $current_user->user_login . "
";
      echo 'User email: ' . $current_user->user_email . "
";
      echo 'User first name: ' . $current_user->user_firstname . "
";
      echo 'User last name: ' . $current_user->user_lastname . "
";
      echo 'User display name: ' . $current_user->display_name . "
";
      echo 'User ID: ' . $current_user->ID . "
";
*/
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main"> 
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- COLLAPSIBLE NAVBAR -->
				<div class="collapse navbar-collapse" id="alignment-example">

				<!-- Links -->
				<ul class="nav navbar-nav navbar-right">
					<li class="nav-brand"><a class="navbar-brand" href="#">Cart</a></li>
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">hello, <?php echo $current_user->user_login ?> 
 <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="logout">
						<?php if (is_user_logged_in()) : ?>
    <li><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
<?php endif;?>
					</ul>
					</li>
				</ul>


				</div>

			</div>
		</nav>
	</main>
</div>




<?php 
get_footer();
