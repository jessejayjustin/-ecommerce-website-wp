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

function forgot_pass_reset_css_styles() {
	wp_enqueue_style( 'wp_starter_kit-style', get_stylesheet_uri() ); 
    wp_enqueue_style( 'forgot-pass-reset-style', get_template_directory_uri() . '/css/forgot-pass-reset.css' ); // our stylesheet
}
add_action( 'wp_enqueue_scripts', 'forgot_pass_reset_css_styles');

function home_css_styles() {
	wp_enqueue_style( 'wp_starter_kit-style', get_stylesheet_uri() ); 
    wp_enqueue_style( 'home-style', get_template_directory_uri() . '/css/home.css' ); // our stylesheet
}
add_action( 'wp_enqueue_scripts', 'home_css_styles');

function single_product_css_styles() {
	wp_enqueue_style( 'wp_starter_kit-style', get_stylesheet_uri() ); 
    wp_enqueue_style( 'single-product-style', get_template_directory_uri() . '/css/single-product.css' ); // our stylesheet
}
add_action( 'wp_enqueue_scripts', 'single_product_css_styles');

function cart_css_styles() {
	wp_enqueue_style( 'wp_starter_kit-style', get_stylesheet_uri() ); 
    wp_enqueue_style( 'cart-style', get_template_directory_uri() . '/css/cart.css' ); // our stylesheet
}
add_action( 'wp_enqueue_scripts', 'cart_css_styles');

function fontawesome_enqueue_styles() {
    wp_enqueue_style( 'wp_starter_kit-style', get_stylesheet_uri() ); 
    wp_enqueue_style( 'fontawesome-style', get_template_directory_uri() . '/fonts/font-awesome.min.css' ); // our stylesheet
}
add_action( 'wp_enqueue_scripts', 'fontawesome_enqueue_styles');



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

add_action('wp_enqueue_scripts', 'enqueue_index_js');
function enqueue_index_js() {
    wp_enqueue_script('index', get_stylesheet_directory_uri().'/js/index.js', 
    array(), false, true);
}

add_action('wp_enqueue_scripts', 'enqueue_product_search');
function enqueue_product_search() {
    wp_enqueue_script('product-search', get_stylesheet_directory_uri().'/js/product-search-script.js',
    array(), false, true);
}

add_action('wp_enqueue_scripts', 'enqueue_nav_filter');
function enqueue_nav_filter() {
    wp_enqueue_script('nav-filter', get_stylesheet_directory_uri().'/js/nav-filter.js',
    array(), false, true);
}

add_action('wp_enqueue_scripts', 'enqueue_filter_cat');
function enqueue_filter_cat() {
    wp_enqueue_script('filter-cat', get_stylesheet_directory_uri().'/js/filter-cat.js',
    array(), false, true);
}

add_action('wp_enqueue_scripts', 'enqueue_cart');
function enqueue_cart() {
    wp_enqueue_script('cart', get_stylesheet_directory_uri().'/js/cart.js',
    array(), false, true);
}

add_action('wp_enqueue_scripts', 'enqueue_checkout');
function enqueue_checkout() {
    wp_enqueue_script('checkout', get_stylesheet_directory_uri().'/js/checkout.js',
    array(), false, true);
}

function ajax_login_init(){

    wp_register_script('ajax-login-script', null, null ); 
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

    if(is_user_logged_in()) {
       $error = 'user is currently logged in!';
    }

    if(empty($username)) {
       $error .= 'username is required';
    }

    if(empty($password)) {
       $error .= 'password is required';
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
  wp_register_script('signin_reg_script', null, null, null, false);
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
    die('Ooops, something went wrong, please try again later.');

    // Post values
    $user = $_POST['user'];
    $email    = $_POST['mail'];
    $password = $_POST['pass'];

    $error = '';

	if (username_exists($user)) {
	    $error = "username in use!";
	} 

	if (email_exists($email)) {
	    $error = "email in use!";
	} 

    if(empty($user)) {
       $error = 'username is required';
    }

    if(empty($email)) {
       $error = 'email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $error = 'enter valid email';
    }

    if(empty($password)) {
       $error = 'password is required';
    }

    /*
    if( false == get_user_by( 'email', $email ) ) {
        echo "The user doesn't exist";
    } else {
         $error .= "The user exists";
    }
    */

    $userdata = array(
        'user_login' => $user,
        'user_pass'  => $password,
        'user_email' => $email,
    );

    if(empty($error) /* || $exists */) {
	    $user_id = wp_insert_user( $userdata );
	    // Return
	    if( is_wp_error($user_id) ) {
	        echo json_encode(array('signin'=>false, 'message'=>__('Ooops, something went wrong, please try again.')));
	    } else {
	        echo json_encode(array('signin'=>true, 'message'=>__('Signin successful, redirecting...')));
	    }
	} else {
		echo json_encode(array('signin'=>false, 'message'=>__($error)));
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

    if( ( !is_front_page() && !is_page('signin') && !is_page('reset-setting-password')) && !is_page('forgot-pass') && !is_page('wp-login') ) {

        if (!is_user_logged_in() ) {
            wp_redirect( site_url(is_front_page()) );        // redirect all...
            exit();
        }

    }

});

/*
Our custom post type function
function create_posttype() {
 
    register_post_type( 'products',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Products' ),
                'singular_name' => __( 'Product' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'products'),
            'show_in_rest' => true,
 
        )
    );
}
//Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
*/

/*
* Creating a function to create our CPT
*/
/*
function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Products', 'Post Type General Name', 'zack-market' ),
        'singular_name'       => _x( 'Product', 'Post Type Singular Name', 'zack-market' ),
        'menu_name'           => __( 'Products', 'zack-market' ),
        'parent_item_colon'   => __( 'Parent Product', 'zack-market' ),
        'all_items'           => __( 'All Products', 'zack-market' ),
        'view_item'           => __( 'View Product', 'zack-market' ),
        'add_new_item'        => __( 'Add New Product', 'zack-market' ),
        'add_new'             => __( 'Add New', 'zack-market' ),
        'edit_item'           => __( 'Edit Product', 'zack-market' ),
        'update_item'         => __( 'Update Product', 'zack-market' ),
        'search_items'        => __( 'Search Product', 'zack-market' ),
        'not_found'           => __( 'Not Found', 'zack-market' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'zack-market' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'products', 'zack-market' ),
        'description'         => __( 'Product categories', 'zack-market' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'category' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
 
    );
     
    // Registering your Custom Post Type
    register_post_type( 'products', $args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 

 
add_action( 'init', 'custom_post_type', 0 );
*/

//hook into the init action and call create_price_taxonomies when it fires
 
add_action( 'init', 'create_price_hierarchical_taxonomy', 0 );
 
//create a custom taxonomy name it class for your posts
 
function create_price_hierarchical_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $labels = array(
    'name' => _x( 'Price', 'taxonomy general name' ),
    'singular_name' => _x( 'Pr', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Price' ),
    'all_items' => __( 'All Price' ),
    'parent_item' => __( 'Parent Pr' ),
    'parent_item_colon' => __( 'Parent Pr:' ),
    'edit_item' => __( 'Edit Pr' ), 
    'update_item' => __( 'Update Pr' ),
    'add_new_item' => __( 'Add New Pr' ),
    'new_item_name' => __( 'New Pr Name' ),
    'menu_name' => __( 'Price' ),
  );    
 
// Now register the taxonomy
  register_taxonomy('price',array('product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'pr' ),
  ));
 
}

//hook into the init action and call create_cat_taxonomies when it fires
 
add_action( 'init', 'create_cat_hierarchical_taxonomy', 0 );
 
//create a custom taxonomy name it class for your posts
 
function create_cat_hierarchical_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $labels = array(
    'name' => _x( 'Cats', 'taxonomy general name' ),
    'singular_name' => _x( 'Cat', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Cats' ),
    'all_items' => __( 'All Cats' ),
    'parent_item' => __( 'Parent Cat' ),
    'parent_item_colon' => __( 'Parent Cat:' ),
    'edit_item' => __( 'Edit Cat' ), 
    'update_item' => __( 'Update Cat' ),
    'add_new_item' => __( 'Add New Cat' ),
    'new_item_name' => __( 'New Cat Name' ),
    'menu_name' => __( 'Cats' ),
  );    
 
// Now register the taxonomy
  register_taxonomy('cats',array('product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cat' ),
  ));
 
}

function ajax_search_scripts() {
  // Enqueue script
  wp_register_script('ajax-search-script', null, null, null, false);
  wp_enqueue_script('ajax-search-script');
 
  wp_localize_script( 'ajax-search-script', 'ajax_search_vars', array( 
    'ajax_search_url' => admin_url( 'admin-ajax.php' )
  ));
}
add_action('wp_enqueue_scripts', 'ajax_search_scripts', 100);

function ajax_search() {

    global $wpdb;

    if(!empty($_POST['search'])) {
       $search = trim($_POST['search']);
    } else {
        return null;
    }
    
    /*
    if(preg_match("/\b(jeans|jackets)\b/ui", strtolower($search) )) {
      $term = $search;
    } else if(preg_match("/\b(men|women)\b/ui", strtolower($search) )) {
      $term = $search;
    } else {
      $term = '';
    }
    
    //$tax_query = array();
    $tax_query[] = array(
        'taxonomy' => 'category',
        'field' => 'slug',
        'terms' => 'Men'
    );
    */
    $args = array(
        'post_type' => 'products',
        'posts_per_page' => -1,
        //'tax_query' => $tax_query,
        's' => $search
    );

    $query = new WP_Query($args);
    
    /*
    $t = $wpdb->get_results(" SELECT name FROM ".$wpdb->prefix."terms WHERE name LIKE '%".$search."%'  ");

    $at = array();

    if($t) {
        foreach($t as $trm) { 
            $at[] = array(
                'term' => $trm->name,
            );
        }
    }
    */
    /*
    $args = array(
        'taxonomy'      => array('category', 'class'), // taxonomy name
        'orderby'       => 'id', 
        'order'         => 'ASC',
        'hide_empty'    => false,
        'fields'        => 'all',
        'operator'    => 'LIKE',
        'search'    => $search
    ); 

    $search_query = get_terms( $args );
    
    $termsArr = array();
    if ( $search_query ) {
        foreach($search_query as $term) { 
            $termsArr[] = array(
                'term' => $term->name,
            );
        }
    } 
    */
    if($query->have_posts()) {

        $results = array();

        while ( $query->have_posts() ) {
            $query->the_post();
            //$terms = strip_tags( get_the_category_list(", ") );
            $results[] = array(
                "id" => get_the_ID(),
                "title" => get_the_title()
                //"terms" =>  $termsArr
            );
        }
        wp_reset_query();

        echo json_encode($results);

    } else {
        echo 0;
    }

    wp_die();
}

add_action('wp_ajax_search', 'ajax_search');
add_action('wp_ajax_nopriv_search', 'ajax_search');


add_action('init', 'myStartSession', 1);
function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

remove_filter('the_content', 'wpautop');
/*
add_action ('wp_loaded', 'my_custom_redirect');
function my_custom_redirect() {
    if ( empty($_SESSION["checkout_cart"])  ) {
       
        wp_redirect(home_url());
        exit;
    }
}     
*/

##### WOOCOMMERCE #####

// Display Fields
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');
// Save Fields
add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save');

function woocommerce_product_custom_fields()
{
    global $woocommerce, $post;
    echo '<div class="product_custom_field">';
    // Custom Product Text Field
    woocommerce_wp_text_input(
        array(
            'id' => '_color',
            'placeholder' => 'Color',
            'label' => __('Color', 'woocommerce'),
            'desc_tip' => 'true'
        )
    );
    /*
    //Custom Product Number Field
    woocommerce_wp_text_input(
        array(
            'id' => '_custom_product_number_field',
            'placeholder' => 'Custom Product Number Field',
            'label' => __('Custom Product Number Field', 'woocommerce'),
            'type' => 'number',
            'custom_attributes' => array(
                'step' => 'any',
                'min' => '0'
            )
        )
    );
    //Custom Product  Textarea
    woocommerce_wp_textarea_input(
        array(
            'id' => '_custom_product_textarea',
            'placeholder' => 'Custom Product Textarea',
            'label' => __('Custom Product Textarea', 'woocommerce')
        )
    );
    */
    echo '</div>';
}

function woocommerce_product_custom_fields_save($post_id)
{
    // Custom Product Text Field
    $woocommerce_custom_product_text_field = $_POST['_color'];
    if (!empty($woocommerce_custom_product_text_field))
        update_post_meta($post_id, '_color', esc_attr($woocommerce_custom_product_text_field));
/*
// Custom Product Number Field
    $woocommerce_custom_product_number_field = $_POST['_custom_product_number_field'];
    if (!empty($woocommerce_custom_product_number_field))
        update_post_meta($post_id, '_custom_product_number_field', esc_attr($woocommerce_custom_product_number_field));
// Custom Product Textarea Field
    $woocommerce_custom_procut_textarea = $_POST['_custom_product_textarea'];
    if (!empty($woocommerce_custom_procut_textarea))
        update_post_meta($post_id, '_custom_product_textarea', esc_html($woocommerce_custom_procut_textarea));
*/
}

/**
 * @snippet       Automatically Update Cart on Quantity Change - WooCommerce
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=73470
 * @author        Rodolfo Melogli
 * @compatible    Woo 3.4
 */

add_action( 'wp_footer', 'ava_cart_refresh_update_qty', 9999 ); 
function ava_cart_refresh_update_qty() { 
    if (is_cart()) { 
        ?> 
        <script type="text/javascript">
        (function($) {
            var triggerUpdate = function() {
                $('.qib-container').on('click', '.qty, .plus, .minus', function(){ 
                    console.log('test');
                    $("button[name='update_cart']").trigger("click");
                });
            }

            triggerUpdate();
           
            $(document).ajaxComplete(function() {
                triggerUpdate();
            });

        })(jQuery);
        </script> 
        <?php 
    } 
}

function get_custom_post_type_template($single_template) {
 global $post;

 if ($post->post_type == 'product') {
      $single_template = dirname( __FILE__ ) . './woocommerce/single-template.php';
 }
 return $single_template;
}
add_filter( 'single_template', 'get_custom_post_type_template' );


/**
 * Here we are trying to add your custom data as Cart Line Item
 * SO that we can add this custom data on your cart, checkout, order and email later
 */
function save_custom_data( $cart_item_data, $product_id ) {
    $custom_data = get_post_meta( $product_id, '_gram', true );
    if( $custom_data != null && $custom_data != ""  ) {
        $cart_item_data["gram"] = $custom_data;
    }
    return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'save_custom_data', 10, 2 );

/**
 * Here we are trying to display that custom data on Cart Table & Checkout Order Review Table 
 */
function render_custom_data_on_cart_checkout( $cart_data, $cart_item = null ) {
    $custom_items = array();
    /* Woo 2.4.2 updates */
    if( !empty( $cart_data ) ) {
        $custom_items = $cart_data;
    }
    if( isset( $cart_item["gram"] ) ) {
        $custom_items[] = array( "name" => "Gram", "value" => $cart_item["gram"] );
    }
    return $custom_items;
}
add_filter( 'woocommerce_get_item_data', 'render_custom_data_on_cart_checkout', 10, 2 );

/**
 * We are adding that custom data ( gram ) as Order Item Meta, 
 * which will be carried over to EMail as well 
 */
function save_custom_order_meta( $item_id, $values, $cart_item_key ) {
    if( isset( $values["gram"] ) ) {
        wc_add_order_item_meta( $item_id, "Gram", $values["gram"] );
    }
}
add_action( 'woocommerce_add_order_item_meta', 'save_custom_order_meta', 10, 3 );
