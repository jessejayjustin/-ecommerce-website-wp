<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_starter_kit
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<title>Xyz Market</title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- <link rel="icon" href="../../favicon.ico"> -->
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<!-- <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->
	<!-- Custom styles for this template -->
	<link href="blog.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- <link rel="profile" href="https://gmpg.org/xfn/11"> -->
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
	<?php wp_head(); ?>
	<script type="text/javascript">
		if ( window.history.replaceState ) {
		  window.history.replaceState( null, null, window.location.href );
		}
	</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp_starter_kit' ); ?></a>
</div>
    <div id="content" class="site-content">
    <!-- 
    <nav class="my-navbar navbar navbar-default">
		<div class="wrapper">
		    Brand and toggle get grouped for better mobile display 
	        <div class="navbar-header text-center">
		        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		          <span class="sr-only">Toggle navigation</span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </button>
		        <div class="navbar-brand-logo">
		            <a class="navbar-brand" href="http://localhost/wordpress/">Brand</a>
		        </div>
	        </div>

	        Collect the nav links, forms, and other content for toggling 
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		        <ul class="nav navbar-nav">
		          <li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
		            <ul class="dropdown-menu">
		              	<?php
		              	/*
						wp_nav_menu(
							array(
								'theme_location' => 'dropdown-menu',
								'items_wrap' => '%3$s', 
								'container' => false,
								'walker' => new AWP_Menu_Walker()
							)
						);
						*/
						?>
		            </ul>
		          </li>
		           	<?php
		           	    /*
						wp_nav_menu(
							array(
								'theme_location' => 'top-menu',
								'items_wrap' => '%3$s', 
								'container' => false,
								'walker' => new AWP_Menu_Walker()
							)
						);
						*/
					?>
		        </ul>
		    </div> /.navbar-collapse 
		</div> /.container-fluid 
		
	</nav> #site-navigation -->
	
