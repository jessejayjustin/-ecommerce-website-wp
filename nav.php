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

<div class="navbar navbar-default clearfix" id="navbar-top">
	<div class="wrapp">
		<div class="container-fluid">
			<!-- COLLAPSIBLE NAVBAR -->
			<div class="collapse navbar-collapse" id="alignment-example">
				<!-- Links -->
				<ul class="nav navbar-nav navbar-right">
					<li class="nav-brand"><a class="navbar-brand" href="<?php echo home_url('cart-2'); ?>">Cart</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">hello, <?php echo $current_user->user_login ?> 
						<span class="caret"></span></a>
						<ul class="dropdown-menu clearfix" aria-labelledby="logout">
							<?php if (is_user_logged_in()) : ?>
						<li><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
						<?php endif;?>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<nav class="navbar navbar-default clearfix" id="navbar-sub">
    <div class="wrapp">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="<?php echo home_url('home'); ?>">
	      	<span>Zack</span>
	      	<span>Market</span>
	      </a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse clearfix" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Women <span class="caret"></span></a>
	          <ul class="dropdown-menu" id="nav_filter_women">
	            <li class="catW"><a href="#">Jeans</a></li>
	            <li class="catW"><a href="#">Jackets</a></li>
	          </ul>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Men <span class="caret"></span></a>
	          <ul class="dropdown-menu" id="nav_filter_men">
	            <li class="catM"><a href="#">Jeans</a></li>
	            <li class="catM"><a href="#">Jackets</a></li>
	          </ul>
	        </li>
	        <li class="all-pr"><a class="all-product" id="all_product" href="#">All Product</a></li>
	      </ul><br><br>
	      <div class="navbar-right clearfix">
		    <form class="navbar-form" data-js-form="search">
			    <div class="form-group">
			        <input type="text" id="searchProd" autocomplete="off">
			        <button type="submit" class="btn">Search</button>
			    </div>
			    <ul id="searchResult"></ul>
		    </form>
	      </div>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
    </div>
</nav>