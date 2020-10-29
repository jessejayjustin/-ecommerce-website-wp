<?php
/**
 * wp_starter_kit functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wp_starter_kit
 */

if ( ! function_exists( 'wp_starter_kit_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wp_starter_kit_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wp_starter_kit, use a find and replace
		 * to change 'wp_starter_kit' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wp_starter_kit', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'wp_starter_kit' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wp_starter_kit_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'wp_starter_kit_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_starter_kit_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'wp_starter_kit_content_width', 640 );
}
add_action( 'after_setup_theme', 'wp_starter_kit_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_starter_kit_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wp_starter_kit' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wp_starter_kit' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'wp_starter_kit' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here.', 'wp_starter_kit' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wp_starter_kit_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wp_starter_kit_scripts() {
	wp_enqueue_style( 'wp_starter_kit-style', get_stylesheet_uri() );

	wp_enqueue_script( 'wp_starter_kit-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'wp_starter_kit-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_starter_kit_scripts' );

function bootstrapstarter_enqueue_styles() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css' );
    $dependencies = array('bootstrap');
    wp_enqueue_style( 'bootstrapstarter-style', get_stylesheet_uri(), $dependencies ); 
}

function bootstrapstarter_enqueue_scripts() {
    $dependencies = array('jquery');
    wp_enqueue_script('bootstrap', get_template_directory_uri(). '/bootstrap/js/bootstrap.min.js', $dependencies, '3.3.7', false );
}
add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_scripts' );

function signin_page_css_styles() {
	wp_enqueue_style( 'wp_starter_kit-style', get_stylesheet_uri() ); 
    wp_enqueue_style( 'signin-page-style', get_template_directory_uri() . '/css/signin.css' ); // our stylesheet
}
add_action( 'wp_enqueue_scripts', 'signin_page_css_styles');

function login_page_css_styles() {
	wp_enqueue_style( 'wp_starter_kit-style', get_stylesheet_uri() ); 
    wp_enqueue_style( 'login-page-style', get_template_directory_uri() . '/css/login.css' ); // our stylesheet
}
add_action( 'wp_enqueue_scripts', 'login_page_css_styles');

function forgot_pass_css_styles() {
	wp_enqueue_style( 'wp_starter_kit-style', get_stylesheet_uri() ); 
    wp_enqueue_style( 'forgot-pass-page-style', get_template_directory_uri() . '/css/forgot-pass.css' ); // our stylesheet
}
add_action( 'wp_enqueue_scripts', 'forgot_pass_css_styles');

function reset_pass_page_css_styles() {
	wp_enqueue_style( 'wp_starter_kit-style', get_stylesheet_uri() ); 
    wp_enqueue_style( 'reset-pass-page-style', get_template_directory_uri() . '/css/reset-setting-pass.css' ); // our stylesheet
}
add_action( 'wp_enqueue_scripts', 'reset_pass_page_css_styles');

function home_page_css_styles() {
	wp_enqueue_style( 'wp_starter_kit-style', get_stylesheet_uri() ); 
    wp_enqueue_style( 'home-page-style', get_template_directory_uri() . '/css/home-page.css' ); // our stylesheet
}
add_action( 'wp_enqueue_scripts', 'home_page_css_styles');


function wpb_custom_new_menu() {
  register_nav_menus(
    array(
      'dropdown-menu' => __( 'Dropdown Menu' ),
      'top-menu' => __( 'Top Menu' )
    )
  );
}
add_action( 'init', 'wpb_custom_new_menu' );

class AWP_Menu_Walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
		$output .= "<li>";
 
		if ($item->url && $item->url != '#') {
			$output .= '<a href="' . $item->url . '">';
		} else {
			$output .= '<span>';
		}
 
		$output .= $item->title;
 
		if ($item->url && $item->url != '#') {
			$output .= '</a>';
		} else {
			$output .= '</span>';
		}
	}
}

/* Custom script with no dependencies, enqueued in the footer */
add_action('wp_enqueue_scripts', 'enqueue_jquery_validate');
function enqueue_jquery_validate() {
    wp_enqueue_script('jquery-validate', get_stylesheet_directory_uri().'/js/jquery.validate.min.js', 
    array(), false, true);
}

add_action('wp_enqueue_scripts', 'enqueue_verify_js');
function enqueue_verify_js() {
    wp_enqueue_script('verify', get_stylesheet_directory_uri().'/js/verify.js', 
    array(), false, true);
}

function ajax_login_init(){

    wp_register_script('ajax-login-script', get_template_directory_uri() . '/js/ajax-login-script.js', array('jquery') ); 
    wp_enqueue_script('ajax-login-script');

    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'ajax_login_init');
}

function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

      // Post values
    $username = $_POST['username'];
    $password = $_POST['password'];

    $error = '';

    if(empty($username)) {
       $error .= 'Enter Username ';
    }

    if(empty($password)) {
       $error .= 'Password should not be blank';
    }

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $username;
    $info['user_password'] = $password;
    $info['remember'] = true;
    
    if(empty($error)) {
	    $user_signon = wp_signon( $info, false );
	    if ( is_wp_error($user_signon) ){
	        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
	    } else {
	        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
	    }
	} else {
		echo $error;
	}

    die();
}

function signin_user_scripts() {
  // Enqueue script
  wp_register_script('signin_reg_script', get_template_directory_uri() . '/js/ajax-signin-script.js', array('jquery'), null, false);
  wp_enqueue_script('signin_reg_script');
 
  wp_localize_script( 'signin_reg_script', 'signin_reg_vars', array(
        'signin_ajax_url' => admin_url( 'admin-ajax.php' ),
      )
  );
}
add_action('wp_enqueue_scripts', 'signin_user_scripts', 100);

/**
 * New User registration
 *
 */
function ajax_signin_new_user() {
  // Verify nonce
  if(!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'signin_new_user'))
    die( 'Ooops, something went wrong, please try again later.' );

    //$exists = email_exists($_POST['signin_email']);
	
    // Post values
    $username = $_POST['user'];
    $email    = $_POST['mail'];
    $password = $_POST['pass'];

    $error = '';

    if(empty($username)) {
       $error .= 'Enter Username ';
    }

    if(empty($email)) {
       $error .= 'Enter Email Id ';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $error .= 'Enter Valid Email ';
    }

    if(empty($password)) {
       $error .= 'Password should not be blank';
    }

    /*
    if( false == get_user_by( 'email', $email ) ) {
        echo "The user doesn't exist";
    } else {
         $error .= "The user exists";
    }
    */

    $userdata = array(
        'user_login' => $username,
        'user_pass'  => $password,
        'user_email' => $email,
    );

    if(empty($error) /* || $exists */) {
	    $user_id = wp_insert_user( $userdata );
	    // Return
	    if( !is_wp_error($user_id) ) {
	        echo '1';
	    } else {
	        echo $user_id->get_error_message();
	    }
	} else {
		echo $error;
		//echo json_encode(array('err'=>true, 'message'=>__($error)));
	}

  die();
}
 
add_action('wp_ajax_register_user', 'ajax_signin_new_user');
add_action('wp_ajax_nopriv_register_user', 'ajax_signin_new_user');

/*
function forgot_pass_reset_scripts() {
  // Enqueue script
  wp_register_script('forgot_pass_script', get_template_directory_uri() . '/js/forgot-pass-reset.js', array('jquery'), null, false);
  wp_enqueue_script('forgot_pass_script');
 
  wp_localize_script( 'forgot_pass_script', 'forgot_pass_object', array(
        'forgot_pass_url' => admin_url( 'admin-ajax.php' ),
      )
  );
}
add_action('wp_enqueue_scripts', 'forgot_pass_reset_scripts', 100);


function forgot_password_reset_email() {
	if(!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'forgot_pass'))
    die( 'Ooops, something went wrong, please try again later.' );

    $us = $_POST['usml'];

    if(empty($us)) {
	  echo '0';
	} else {
		echo '1';
	}

    die();
}

add_action('wp_ajax_forgot_pass', 'forgot_password_reset_email');
add_action('wp_ajax_nopriv_forgot_pass', 'forgot_password_reset_email');
*/


add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action("wp_ajax_login_form", "handle_login_form");

function handle_login_form() {
	print_r($_REQUEST);
	wp_die();
}

add_action( 'template_redirect', function() {

    if( ( !is_front_page() && !is_page('signin') && !is_page('reset-setting-password')) && !is_page('forgot-pass-reset') ) {

        if (!is_user_logged_in() ) {
            wp_redirect( site_url(is_front_page()) );        // redirect all...
            exit();
        }

    }

});

