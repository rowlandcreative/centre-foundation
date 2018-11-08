<?php
/**
 * Centre Foundation functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Centre_Foundation
 */

if ( ! function_exists( 'centre_foundation_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function centre_foundation_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Centre Foundation, use a find and replace
		 * to change 'centre_foundation' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'centre_foundation', get_template_directory() . '/languages' );

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
			'menu_main' => esc_html__( 'Main', 'centre_foundation' ),
			'menu_top' => esc_html__( 'Top', 'centre_foundation' )
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
		add_theme_support( 'custom-background', apply_filters( 'centre_foundation_custom_background_args', array(
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
add_action( 'after_setup_theme', 'centre_foundation_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function centre_foundation_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'centre_foundation_content_width', 640 );
}
add_action( 'after_setup_theme', 'centre_foundation_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function centre_foundation_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'centre_foundation' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'centre_foundation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'centre_foundation_widgets_init' );

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

/********************************************************/
/************** ENQUEUE SCRIPTS AND STYLES  *************/
/********************************************************/

/**
 * Enqueue scripts and styles for development.
 */
function centre_foundation_scripts() {

	// enqueue jquery the right way
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), null, false ); 

	// enqueue jquery components ***
	wp_enqueue_script( 'lazy', get_template_directory_uri() . '/js/jquery.lazy-master/jquery.lazy.min.js', array('jquery'), null, true ); 
	// wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick/slick.min.js', array('jquery'), null, true ); 
	// wp_enqueue_style( 'slick-style', get_template_directory_uri() . '/js/slick/slick.css');
	// wp_enqueue_style( 'slick-theme-style', get_template_directory_uri() . '/js/slick/slick-theme.css');

	// enqueue foundation styles and scripts ***
	wp_enqueue_style( 'foundation-style', get_template_directory_uri() . '/css/foundation.min.css');
	wp_enqueue_script( 'what-input', get_template_directory_uri() . '/js/vendor/what-input.js', array(), null, true );
	wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/vendor/foundation.min.js', array('jquery'), null, true );
	
	// enqueue Google fonts: Roboto Slab and Open Sans
	wp_enqueue_style( 'google-fonts-style', 'https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700|Open+Sans:400,600,700' );
		
	// enqueue font-awesome styles
	wp_enqueue_style( 'font-awesome-style', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );

	// enqueue _s styles and scripts ***
	wp_enqueue_style( 'centre_foundation-style', get_stylesheet_uri() );
	wp_enqueue_script( 'centre_foundation-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'centre_foundation-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	// enqueue main styles and scripts
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/css/app.css' );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/app.js', array(), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'centre_foundation_scripts' );

// /**
//  * Enqueue scripts and styles for production.
//  */
// function centre_foundation_scripts() {

// 	// enqueue jquery the right way
// 	wp_deregister_script( 'jquery' );
// 	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), null, false ); 

// 	// enqueue Google fonts: Roboto Slab and Open Sans
// 	wp_enqueue_style( 'google-fonts-style', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800' );

// 	// enqueue font-awesome styles
// 	wp_enqueue_style( 'font-awesome-style', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );
	
// 	// enqueue main styles and scripts
// 	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/dist/app.min.css' );
// 	wp_enqueue_script( 'main', get_template_directory_uri() . '/dist/app.min.js', array(), null, true );
	
// 	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
// 		wp_enqueue_script( 'comment-reply' );
// 	}
// }
// add_action( 'wp_enqueue_scripts', 'centre_foundation_scripts' );

/********************************************************/
/****************** MODIFY ADMIN MENU *******************/
/********************************************************/

/**
 * Remove admin menu options by user.
 */
function remove_admin_menu_options(){
	$current_user = wp_get_current_user();
    if  ( $current_user->user_login != 'peter' ) {
		remove_menu_page( 'edit.php' );									//Posts
		// remove_menu_page( 'upload.php' );                				//Media
		remove_menu_page( 'edit-comments.php' );        		 	 	//Comments
		// remove_menu_page( 'themes.php' );								//Appearance
		// remove_menu_page( 'plugins.php' );								//Plugins
		// remove_menu_page( 'users.php' );									//Users
		remove_menu_page( 'tools.php' );									//Tools
		remove_menu_page( 'options-general.php' );       				//Settings
			// remove_submenu_page( 'options-general.php', 'hicpo-settings' );	//Intuitive CPO
			// remove_submenu_page( 'options-general.php', 'searchwp' );	//Intuitive CPO
			// remove_submenu_page( 'options-general.php', 'tinymce-advanced' );	//TinyMCE Advanced
			// remove_submenu_page( 'options-general.php', 'nested-pages-settings' );	 //Nested Pages
			// remove_submenu_page( 'options-general.php', 'whl_settings' );	//WPS Hide Login
			// remove_submenu_page( 'options-general.php', 'limit-login-attempts' );	//Limit Login Attempts
			// remove_submenu_page( 'options-general.php', 'facetwp' );	 //FacetWP
		remove_menu_page( 'edit.php?post_type=acf-field-group' ); 		//ACF
		remove_menu_page( 'cptui_main_menu' );			  				//CPT
	}
	else {
		remove_menu_page( 'edit.php' );                   				//Posts
		remove_menu_page( 'edit-comments.php' );          				//Comments
	}
}
add_action('admin_menu', 'remove_admin_menu_options');

/********************************************************/
/*********************** BRANDING  **********************/
/********************************************************/

/**
 * Link custom CSS to login page
 */ 
function my_custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/css/login.css" />';
}
add_action('login_head', 'my_custom_login');

/**
 * Change WordPress login page logo link href attribute
 */ 
function wp_debranding_change_login_page_url($login_header_url) {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'wp_debranding_change_login_page_url' );

/**
 * Change WordPress login page logo link title attribute
 */ 
function wp_debranding_change_login_page_title($login_header_title) {
    return get_bloginfo('description');
}
add_filter( 'login_headertitle', 'wp_debranding_change_login_page_title' );

/**
 * Modify admin footer
 */
function change_admin_footer () {
	echo '<span id="footer-thankyou"><img src="' . get_template_directory_uri() . '/img/Rowland_Icon_1c_Orange_RGB.svg" width="10px">  Brought to you by your friends at <a href="http://www.rowlandcreative.com" target="_blank">Rowland Creative</a></span>';
}
add_filter('admin_footer_text', 'change_admin_footer');

/**
 * Remove WordPress logo and menu from admin bar
 */
function wp_debranding_remove_wp_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}
add_action( 'wp_before_admin_bar_render', 'wp_debranding_remove_wp_logo');
 
/**
 * Customize account menu in admin bar
 */
function wp_admin_bar_my_custom_account_menu($wp_admin_bar) {
	$user_id = get_current_user_id();
	$current_user = wp_get_current_user();
	$profile_url = get_edit_profile_url($user_id);

	if (0 != $user_id) {
		/* Add the "My Account" menu */
		$avatar = get_avatar($user_id, 28);
		$howdy = sprintf(__('Welcome, %1$s'), $current_user -> display_name);
		$class = empty($avatar) ? '' : 'with-avatar';

		$wp_admin_bar -> add_menu(array(
			'id' => 'my-account',
			'parent' => 'top-secondary',
			'title' => $howdy.$avatar,
			'href' => $profile_url,
			'meta' => array(
				'class' => $class,
			),
		));

	}
}
add_action('admin_bar_menu', 'wp_admin_bar_my_custom_account_menu', 11);

/********************************************************/
/****************** ClEAN UP DASHBOARD ******************/
/********************************************************/

/**
 * Clean up Dashboard
 */
function remove_dashboard_meta() {
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Removes the 'incoming links' widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); //Removes the 'plugins' widget
	remove_meta_box('dashboard_primary', 'dashboard', 'normal'); //Removes the 'WordPress News' widget
	remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); //Removes the secondary widget
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Removes the 'Quick Draft' widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Removes the 'Recent Drafts' widget
	// remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
	// remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //Removes the 'Activity' widget (since 3.8)
}
add_action('admin_init', 'remove_dashboard_meta');

/**
 * Remove the welcome panel from Dashboard
 */
remove_action('welcome_panel', 'wp_welcome_panel');

/**
 * Add Rowland Creative panel to Dashboard
 */
function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
 
	wp_add_dashboard_widget('custom_help_widget', 'Rowland Creative', 'custom_dashboard_help');
}
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

/**
 * Define content for Rowland Creative panel
 */
function custom_dashboard_help() {
	echo '<img src="' . get_template_directory_uri() . '/img/Rowland_Icon_1c_Orange_RGB.svg" width="25px">' . '<p>Welcome to the Centre Foundation administrator dashboard.</p><p>Need help? For WordPress tutorials, please take a look at the learning modules available at <a href="https://learn.wordpress.com/" target="_blank">Wordpress.com</a>. </p><p>For problems, please contact our <a href="mailto:peter@rowlandcreative.com">development team</a>.</p>';
}

/**
 * Remove help tabs
 */ 
function mytheme_remove_help_tabs($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}
add_filter( 'contextual_help', 'mytheme_remove_help_tabs', 999, 3 );

/********************************************************/
/********************* COLOR SCHEMES ********************/
/********************************************************/

// /**
//  * Create additional UI color scheme
//  */
// function additional_admin_color_schemes() {
// 	//Get the theme directory
// 	$theme_dir = get_template_directory_uri();
   
// 	//Ocean
// 	wp_admin_css_color( 'ocean', __( 'Ocean' ),
// 	  $theme_dir . '/admin-colors/ocean/colors.min.css',
// 	  array( '#aa9d88', '#9ebaa0', '#738e96', '#f2fcff' )
// 	);
// }
// add_action('admin_init', 'additional_admin_color_schemes');

/**
 * Set default UI color scheme
 */
function set_default_admin_color($user_id) {
    $args = array(
        'ID' => $user_id,
        'admin_color' => 'lawn'
    );
    wp_update_user( $args );
}
add_action('user_register', 'set_default_admin_color');

/**
 * Remove color scheme picker by user
 */
$current_user = wp_get_current_user();
if  ( $current_user->user_login != 'peter' )
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

/********************************************************/
/************************** ACF *************************/
/********************************************************/

// /**
//  * Add Google API key for ACF 
//  */
// function my_acf_init() {

// 	acf_update_setting('google_api_key', 'AIzaSyDPxOMtJz4cOIwWDE84JQdTEFua7HZBL50');
// }
// add_action('acf/init', 'my_acf_init');

/**
 * Add header and footer options page for ACF 
 */
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title' 	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'position' 		=> '65',
		'icon_url' 		=> false,
		'redirect' 		=> true,
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Header Options',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-options',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer Options',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-options',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Misc Options',
		'menu_title'	=> 'Misc',
		'parent_slug'	=> 'theme-options',
	));
}

/**
 * Add sticky meta
 */

function set_default_custom_fields($post_id){
	
	if ( $_GET[‘post_type’] == ‘funds’ ) {
		if ( get_field('sticky', $post_id) ){
			update_post_meta($post_id, ‘sticky’, 1000);
		}
	}
	return true;
}
add_action(‘wp_insert_post’, ‘set_default_custom_fields’);

/********************************************************/
/************************* CPTUI ************************/
/********************************************************/

/**
 * Remove metaboxes
 */
function jon_edit_taxonomy_args( $args, $tax_slug, $cptui_tax_args ) {

	// Set to false for all taxonomies created with CPTUI.
	$args['meta_box_cb'] = false;

	return $args;
}
add_filter( 'cptui_pre_register_taxonomy', 'jon_edit_taxonomy_args', 10, 3 );

/********************************************************/
/************************ TinyMCE ***********************/
/********************************************************/

/**
 * Add fonts.
 */
if ( ! function_exists( 'wpex_mce_google_fonts_array' ) ) {
	function wpex_mce_google_fonts_array( $initArray ) {
		$theme_advanced_fonts = 'Open Sans = Open Sans;';
		$theme_advanced_fonts .= 'Libre Baskerville = Libre Baskerville;';
		$initArray['font_formats'] = $theme_advanced_fonts;
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'wpex_mce_google_fonts_array' );

/**
 * Add font sizes.
 */
if ( ! function_exists( 'wpex_mce_text_sizes' ) ) {
    function wpex_mce_text_sizes( $initArray ){
        $initArray['fontsize_formats'] = "16px 18px 21px 24px";
        return $initArray;
    }
}
add_filter( 'tiny_mce_before_init', 'wpex_mce_text_sizes' );

/**
 * Display fonts in editor.
 */
if ( ! function_exists( 'wpex_mce_google_fonts_styles' ) ) {
	function wpex_mce_google_fonts_styles() {
		$font1 = 'https://fonts.googleapis.com/css?family=Open+Sans';
		add_editor_style( str_replace( ',', '%2C', $font1 ) );
		$font2 = 'https://fonts.googleapis.com/css?family=Libre+Baskerville';
		add_editor_style( str_replace( ',', '%2C', $font2 ) );
	 }
}
add_action( 'admin_init', 'wpex_mce_google_fonts_styles' );

/**
 * Add font colors.
 */
function my_mce4_options( $init ) {
	$default_colours = '
	"58a618", "Green",
	"00505c", "Blue",
	"797979", "Gray",
	';
	$init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';
	$init['textcolor_rows'] = 1; // expand colour grid to 6 rows
	$init['textcolor_cols'] = 3; 

	return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');

/**
 * Remove the Color Picker plugin from tinyMCE. This will
 * prevent users from adding custom colors. Note, the default color
 * palette is still available (and customizable by developers) via
 * textcolor_map using the tiny_mce_before_init hook.
 * 
 * @param array $plugins An array of default TinyMCE plugins.
 */
function wpse_tiny_mce_remove_custom_colors( $plugins ) {       

    foreach ( $plugins as $key => $plugin_name ) {
        if ( 'colorpicker' === $plugin_name ) {
            unset( $plugins[ $key ] );
            return $plugins;            
        }
    }

    return $plugins;            
}
add_filter( 'tiny_mce_plugins', 'wpse_tiny_mce_remove_custom_colors' );

// /**
//  * Add new format options to TinyMCE
//  */
// function my_mce_before_init_insert_formats( $init_array ) {  
// 	// Define the style_formats array
// 	$style_formats = array(  
// 		// Each array child is a format with it's own settings
// 		array(  
// 			'title' => 'Light Font',  
// 			'inline' => 'span',  
// 			// 'styles' => array(
//             //     'font-weight' => '300',
// 			// ),
// 			'classes' => 'light_font',
// 			'wrapper' => true,
// 		), 
// 	);  
// 	// Insert the array, JSON ENCODED, into 'style_formats'
// 	$init_array['style_formats'] = json_encode( $style_formats );  
	
// 	return $init_array;  
  
// } 
// add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 

/********************************************************/
/***************** STORIES, NEWS, EVENTS ****************/
/********************************************************/

/**
 * Set default post type options
 */

add_filter( 'register_post_type_args', function( $args, $name )
{
    if( 'post' === $name )
    {   
		$args['public']        = false; // Public?
        $args['show_ui']        = false; // Display the user-interface
        $args['show_in_nav_menus'] = false; // Display for selection in navigation menus
        $args['show_in_menu']      = false; // Display in the admin menu
        $args['show_in_admin_bar'] = false; // Display in the WordPress admin bar
    }
    return $args;
}, 10, 2 );

// function change_post_object_label() {
//     global $wp_post_types;
//     $labels = &$wp_post_types['post']->labels;
//     $labels->name = 'Articles';
//     $labels->singular_name = 'Add New Article';
//     $labels->add_new = 'Add Article';
//     $labels->add_new_item = 'Add Article';
//     $labels->edit_item = 'Edit Article';
//     $labels->new_item = 'New Article';
//     $labels->view_item = 'View Article';
//     $labels->search_items = 'Search Articles';
//     $labels->not_found = 'No Articles Found';
//     $labels->not_found_in_trash = 'No Articles found in Trash';
// }
// add_action( 'init', 'change_post_object_label' );

// function change_post_menu_label() {
//     global $menu;
//     global $submenu;
//     $menu[5][0] = 'Articles';
//     $submenu['edit.php'][5][0] = 'Articles';
//     $submenu['edit.php'][10][0] = 'Add Article';
//     echo '';
// }
// add_action( 'admin_menu', 'change_post_menu_label' );

/**
 * Offset queries for news & events
 */
function post_offset( $query ) {
	if ($query->is_post_type_archive(array('stories','news','events')) && $query->is_main_query() && !is_admin()) {
		$ppp = get_option('posts_per_page');
		$offset = -1;
		if (!$query->is_paged()) {
			$query->set('posts_per_page',$offset + $ppp);
		} else {
			$offset = $offset + ( ($query->query_vars['paged']-1) * $ppp );
			$query->set('posts_per_page',$ppp);
			$query->set('offset',$offset);
	  	}
	}
}
add_action('pre_get_posts','post_offset');

/**
 * Offset paginations for offset queries
 */
function offset_pagination( $found_posts, $query ) {
	$offset = -1;

	if( $query->is_home() && $query->is_main_query() ) {
		$found_posts = $found_posts - $offset;
	}
	return $found_posts;
}
add_filter( 'found_posts', 'offset_pagination', 10, 2 );

// function wpshout_add_custom_post_types_to_query( $query ) {
// 	if( 
// 		is_archive() &&
// 		$query->is_main_query() &&
// 		empty( $query->query_vars['suppress_filters'] )
// 	) {
// 		$query->set( 'post_type', array( 
// 			'blog',
// 		) );
// 	}
// }
// add_filter( 'pre_get_posts', 'wpshout_add_custom_post_types_to_query' );

/**
 * Add class to first post
 */
function wps_first_post_class( $classes ) {
	global $wp_query;
	if(( 0 == $wp_query->current_post ) && ( !is_paged() )){
		$classes[] = 'first-post';
		return $classes;
	}
};
add_filter( 'post_class', 'wps_first_post_class' );

/**
 * Custom query for events
 */
function meta_query_events( $query ) {
	if (($query->is_post_type_archive('events')) && ($query->is_main_query()) && (!is_admin())) {
		$today = date('Ymd');
		$query->set('meta_query',array(array('key' => 'event_date','value' => $today,'compare' => '>=')));
		$query->set('meta_key','event_date');
		$query->set('orderby','meta_value');
		$query->set('order','ASC');
	}
}
add_action('pre_get_posts','meta_query_events');


/********************************************************/
/*********************** 404 PAGE ***********************/
/********************************************************/

/**
 * Modify the query for WP recent posts widget
 */
function widget_posts_args_add_custom_type($params) {
	$params['post_type'] = array('stories','news','events');
	return $params;
 }
 add_filter('widget_posts_args', 'widget_posts_args_add_custom_type'); 

/********************************************************/
/************** PERFORMANCE ENHANCEMENTS  ***************/
/********************************************************/

/**
 * Remove dashicons from frontend for unauthenticated users
 */
function bs_dequeue_dashicons() {
    if ( ! is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
    }
}
add_action( 'wp_enqueue_scripts', 'bs_dequeue_dashicons' );

/********************************************************/
/****************** GENERATE SITE MAP  ******************/
/********************************************************/

function show_sitemap() {
  if(isset($_GET['show_sitemap'])) {
    $the_query = new WP_Query(array('post_type' => 'any', 'posts_per_page' => '-1', 'post_status' => 'publish'));
    $urls = array();
    while($the_query->have_posts()) {
      $the_query->the_post();
      $urls[] = get_permalink();
    }
    die(json_encode($urls));
  }
}
add_action('template_redirect', 'show_sitemap');

/********************************************************/
/******************** GRAVITY FORMS  ********************/
/********************************************************/

function populate_posts( $form ) {
 
    foreach ( $form['fields'] as &$field ) {
 
        if ( $field->type != 'select' || strpos( $field->cssClass, 'populate-posts' ) === false ) {
            continue;
        }
 
        // you can add additional parameters here to alter the posts that are retrieved
        // more info: http://codex.wordpress.org/Template_Tags/get_posts
        $posts = get_posts( 'post_type=funds&numberposts=-1&post_status=publish&orderby=title&order=ASC' );
 
        $choices = array();
 
        foreach ( $posts as $post ) {
            $choices[] = array( 'text' => $post->post_title, 'value' => $post->post_title );
        }
 
        // update 'Select a Post' to whatever you'd like the instructive option to be
        $field->placeholder = 'Select a Fund';
        $field->choices = $choices;
 
    }
 
    return $form;
}
add_filter( 'gform_pre_render_2', 'populate_posts' );
add_filter( 'gform_pre_validation_2', 'populate_posts' );
add_filter( 'gform_pre_submission_filter_2', 'populate_posts' );
add_filter( 'gform_admin_pre_render_2', 'populate_posts' );


/********************************************************/
/*********************** SearchWP ***********************/
/********************************************************/

/**
 * Provide HTTP Basic Auth creds
 */
function my_searchwp_basic_auth_creds() {
	
	// NOTE: this needs to be your HTTP BASIC AUTH login
	//
	//                 *** NOT *** your WordPress login
	//
	//
	$credentials = array( 
		'username' => 'rowland', // the HTTP BASIC AUTH username
		'password' => 'creative'  // the HTTP BASIC AUTH password
	);
	
	return $credentials;
}
add_filter( 'searchwp_basic_auth_creds', 'my_searchwp_basic_auth_creds' );

/**
 * Add Custom Taxonomies
 */
function my_searchwp_custom_fields($customFieldValue, $customFieldName, $thePost) {
	// by default we're just going to send the original value back
	$contentToIndex = $customFieldValue;
	// check to see if this is one of the ACF Relationship fields we want to process
	if (in_array(strtolower($customFieldName), array('interest', 'size', 'year_established', 'community'))) {
		// we want to index the titles, not the post IDs, so we'll wipe this out and append our titles to it
		$contentToIndex = '';
		// related posts are stored in an array
		if (is_array($customFieldValue)) {
			foreach($customFieldValue as $relatedPostData) {
				if (is_numeric($relatedPostData)) { // if you set the Relationship to store post IDs, it's numeric
					$term = get_term($relatedPostData);
					$name = $term-> name;
					$contentToIndex .= $name.
					' ';
				} else { // it's an array of objects
					$postData = maybe_unserialize($relatedPostData);
					if (is_array($postData) && !empty($postData)) {
						foreach($postData as $postID) {
							$term = get_term(absint($postID));
							$name = $term-> name;
							$contentToIndex .= $name.
							' ';
						}
					}
				}
			}
		}
	}
	return $contentToIndex;
}
add_filter('searchwp_custom_fields', 'my_searchwp_custom_fields', 10, 3);

/**
 * Settings for fuzzy match
 */
function my_fuzzy_word_length() {
	return 5;
}
add_filter('searchwp_fuzzy_min_length', 'my_fuzzy_word_length');

function my_fuzzy_threshold() {
	return 80;
}
add_filter('searchwp_fuzzy_threshold', 'my_fuzzy_threshold');

function myChangeDigitThreshold() {
	return 10; 
}
add_filter('searchwp_fuzzy_digit_threshold', 'myChangeDigitThreshold');

/**
 * Settings for minimum word legnth
 */

function my_searchwp_minimum_word_length() {
	// index and search for words with at least two characters
	return 3;
}
add_filter('searchwp_minimum_word_length', 'my_searchwp_minimum_word_length');

/**
 * Add sticky and change sort
 */

function my_searchwp_query_main_join( $sql, $engine ) {
	global $wpdb;
	$my_meta_key = 'sticky';  // the meta_key you want to order by
	$sql = $sql . " LEFT JOIN {$wpdb->postmeta} ON {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id AND {$wpdb->postmeta}.meta_key = '{$my_meta_key}'";
	return $sql;
}
add_filter( 'searchwp_query_main_join', 'my_searchwp_query_main_join', 10, 2 );

function my_searchwp_query_orderby( $orderby ) {
	global $wpdb;
	$my_order = "DESC"; // use DESC or ASC
	$original_orderby = str_replace( 'ORDER BY', '', $orderby );
	if ( "DESC" === $my_order ) {
		// Sort in descending order
		$new_orderby = "ORDER BY {$wpdb->postmeta}.meta_value+0 DESC, " . $original_orderby;
	} else {
		// Sort in ascending order; place empties last
		// @link http://stackoverflow.com/questions/2051602/mysql-orderby-a-number-nulls-last#8174026
		$new_orderby = "ORDER BY -{$wpdb->postmeta}.meta_value+0 DESC, " . $original_orderby;
	}
	return $new_orderby;
}
add_filter( 'searchwp_query_orderby', 'my_searchwp_query_orderby' );

/**
 * Prevent SearchWP from refining AND results
 */
add_filter( 'searchwp_refine_and_results', '__return_false' );

/**
 * LIKE Terms minimum character
 */
add_filter( 'searchwp_like_min_length', function( $length ) {
    return 3;
}); 