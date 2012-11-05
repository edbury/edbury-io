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

function huftgold_hum_local_types( $types ) {
  $types[] = 'c';
  return $types;
}
add_filter('hum_local_types', 'huftgold_hum_local_types');

function huftgold_hum_type_prefix( $prefix, $post_id ) {
  $post = get_post( $post_id );

  if ( get_post_format( $post->ID ) == 'chat' ) {
    $prefix = 'c';
  }

  return $prefix;
}
add_filter('hum_type_prefix', 'huftgold_hum_type_prefix', 10, 2);

/**
 * Format: Status
 * Twitter username + hashtag filter
 */

function twitterize($status) {
  $pattern = '/\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)((?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))*)/i';
  $status = preg_replace($pattern, "<a href=\"\\0\">\\0</a>", $status );
  $status = preg_replace("/[@]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/\\1\">\\0</a>", $status );
  $status = preg_replace("/[#]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/search?q=%23\\1\">\\0</a>", $status );
  return $status;
}

/**
 * Format: Chat
 */

/* Filter the content of chat posts. */
add_filter( 'the_content', 'my_format_chat_content' );

/* Auto-add paragraphs to the chat text. */
add_filter( 'my_post_format_chat_text', 'wpautop' );

/**
 * This function filters the post content when viewing a post with the "chat" post format.  It formats the 
 * content with structured HTML markup to make it easy for theme developers to style chat posts.  The 
 * advantage of this solution is that it allows for more than two speakers (like most solutions).  You can 
 * have 100s of speakers in your chat post, each with their own, unique classes for styling.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $content The content of the post.
 * @return string $chat_output The formatted content of the post.
 */
function my_format_chat_content( $content ) {
	global $_post_format_chat_ids;

	/* If this is not a 'chat' post, return the content. */
	if ( !has_post_format( 'chat' ) )
		return $content;

	/* Set the global variable of speaker IDs to a new, empty array for this chat. */
	$_post_format_chat_ids = array();

	/* Allow the separator (separator for speaker/text) to be filtered. */
	$separator = apply_filters( 'my_post_format_chat_separator', ':' );

	/* Open the chat transcript div and give it a unique ID based on the post ID. */
	$chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';

	/* Split the content to get individual chat rows. */
	$chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

	/* Loop through each row and format the output. */
	foreach ( $chat_rows as $chat_row ) {

		/* If a speaker is found, create a new chat row with speaker and text. */
		if ( strpos( $chat_row, $separator ) ) {

			/* Split the chat row into author/text. */
			$chat_row_split = explode( $separator, trim( $chat_row ), 2 );

			/* Get the chat author and strip tags. */
			$chat_author = strip_tags( trim( $chat_row_split[0] ) );

			/* Get the chat text. */
			$chat_text = trim( $chat_row_split[1] );

			/* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
			$speaker_id = my_format_chat_row_id( $chat_author );

			/* Open the chat row. */
			$chat_output .= "\n\t\t\t\t" . '<div class="chat-row chat-new-speaker ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

			/* Add the chat row author. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard">' . apply_filters( 'my_post_format_chat_author', $chat_author, $speaker_id ) . $separator . '</div>';

			/* Add the chat row text. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';

			/* Close the chat row. */
			$chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
		}

		/**
		 * If no author is found, assume this is a separate paragraph of text that belongs to the
		 * previous speaker and label it as such, but let's still create a new row.
		 */
		else {

			/* Make sure we have text. */
			if ( !empty( $chat_row ) ) {

				/* Open the chat row. */
				$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

				/* Don't add a chat row author.  The label for the previous row should suffice. */

				/* Add the chat row text. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';

				/* Close the chat row. */
				$chat_output .= "\n\t\t\t\t". "</div><!-- .chat-row -->";
			}
		}
	}

	/* Close the chat transcript div. */
	$chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";

	/* Return the chat content and apply filters for developers. */
	return apply_filters( 'my_post_format_chat_content', $chat_output );
}

/**
 * This function returns an ID based on the provided chat author name.  It keeps these IDs in a global 
 * array and makes sure we have a unique set of IDs.  The purpose of this function is to provide an "ID"
 * that will be used in an HTML class for individual chat rows so they can be styled.  So, speaker "John" 
 * will always have the same class each time he speaks.  And, speaker "Mary" will have a different class 
 * from "John" but will have the same class each time she speaks.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $chat_author Author of the current chat row.
 * @return int The ID for the chat row based on the author.
 */
function my_format_chat_row_id( $chat_author ) {
	global $_post_format_chat_ids;

	/* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
	$chat_author = strtolower( strip_tags( $chat_author ) );

	/* Add the chat author to the array. */
	$_post_format_chat_ids[] = $chat_author;

	/* Make sure the array only holds unique values. */
	$_post_format_chat_ids = array_unique( $_post_format_chat_ids );

	/* Return the array key for the chat author and add "1" to avoid an ID of "0". */
	return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
}

/**
 * POSSE 
 */

require( get_template_directory() . '/inc/posse/twitter.php' );
