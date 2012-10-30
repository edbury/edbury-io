<?php
/**
 * huftgold functions and definitions
 *
 * @package huftgold
 * @since huftgold 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since huftgold 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'huftgold_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since huftgold 1.0
 */
function huftgold_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on huftgold, use a find and replace
	 * to change 'huftgold' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'huftgold', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'huftgold' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside','link','image','quote','status','video','audio','chat' ) );
}
endif; // huftgold_setup
add_action( 'after_setup_theme', 'huftgold_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since huftgold 1.0
 */
function huftgold_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'huftgold' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'huftgold_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function huftgold_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	//Load Fonts
    wp_register_style('arvo', 'http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic');
    wp_enqueue_style( 'arvo');

    wp_register_style('droid-sans-mono', 'http://fonts.googleapis.com/css?family=Droid+Sans+Mono');
    wp_enqueue_style('droid-sans-mono');

    //Header Scripts
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/foundation/modernizr.foundation.js', '' , '2.5.3', false );

    //Footer Scripts
	wp_enqueue_script( 'foundation-reveal', get_template_directory_uri() . '/js/foundation/jquery.reveal.js', array( 'jquery' ), '1.1', true );
	wp_enqueue_script( 'foundation-orbit', get_template_directory_uri() . '/js//foundation/jquery.orbit-1.4.0.js', array( 'jquery' ), '1.4.0', true );
	wp_enqueue_script( 'foundation-custom-forms', get_template_directory_uri() . '/js/foundation/jquery.customforms.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'foundation-placeholder', get_template_directory_uri() . '/js/foundation/jquery.placeholder.min.js', array( 'jquery' ), '2.0.7', true );
	wp_enqueue_script( 'foundation-tooltips', get_template_directory_uri() . '/js/foundation/jquery.tooltips.js', array( 'jquery' ), '2.0.1', true );
	wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/jquery.countdown.js', array( 'jquery' ), '1.0.0beta', true );
	
	if (!is_singular() | strpos($post->post_content,'class="language-') !== false) {
		wp_enqueue_script( 'prism', get_template_directory_uri() . '/js/prism-ck.js', '', '1.0', true );
	}
	wp_enqueue_script( 'app.js', get_template_directory_uri() . '/js/app.js', array( 'jquery' ), '1.0', true );

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'huftgold_scripts' );

/**
 * From WPFill.me / WPFunction.me
 */

// Remove the admin bar from the front end
add_filter( 'show_admin_bar', '__return_false' );


// Customise the footer in admin area
function wpfme_footer_admin () {
	echo 'Theme designed and developed by <a href="http://dver.gr" target="_blank">Edbury Enegren</a> and powered by <a href="http://wordpress.org" target="_blank">WordPress</a>.';
}
add_filter('admin_footer_text', 'wpfme_footer_admin');


// Put post thumbnails into rss feed
function wpfme_feed_post_thumbnail($content) {
	global $post;
	if(has_post_thumbnail($post->ID)) {
		$content = '' . $content;
	}
	return $content;
}
add_filter('the_excerpt_rss', 'wpfme_feed_post_thumbnail');
add_filter('the_content_feed', 'wpfme_feed_post_thumbnail');


//change amount of posts on the search page - set here to 100
function wpfme_search_results_per_page( $query ) {
	global $wp_the_query;
	if ( ( ! is_admin() ) && ( $query === $wp_the_query ) && ( $query->is_search() ) ) {
	$query->set( 'wpfme_search_results_per_page', 100 );
	}
	return $query;
}
add_action( 'pre_get_posts',  'wpfme_search_results_per_page'  );


//create a permalink after the excerpt
function wpfme_replace_excerpt($content) {
	return str_replace('[...]',
		'<a class="readmore" href="'. get_permalink() .'">Continue Reading</a>',
		$content
	);
}
add_filter('the_excerpt', 'wpfme_replace_excerpt');


// Stop images getting wrapped up in p tags when they get dumped out with the_content() for easier theme styling
function wpfme_remove_img_ptags($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'wpfme_remove_img_ptags');


// Call the google CDN version of jQuery for the frontend
// Make sure you use this with wp_enqueue_script('jquery'); in your header
function wpfme_jquery_enqueue() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
	wp_enqueue_script('jquery');
}
if (!is_admin()) add_action("wp_enqueue_scripts", "wpfme_jquery_enqueue", 11);


//custom excerpt length
function wpfme_custom_excerpt_length( $length ) {
	//the amount of words to return
	return 20;
}
add_filter( 'excerpt_length', 'wpfme_custom_excerpt_length');


// Call Googles HTML5 Shim, but only for users on old versions of IE
function wpfme_IEhtml5_shim () {
	global $is_IE;
	if ($is_IE)
	echo '<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->';
}
add_action('wp_head', 'wpfme_IEhtml5_shim');



/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Hum Parameters
 */

add_filter('hum_shortlink_base', create_function('', 'return "http://ere.io/";'));

/**
 * POSSE 
 */

require( get_template_directory() . '/inc/posse/twitter.php' );
