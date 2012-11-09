<?php

function posse_tumblr( $post_ID ) {
	
	$post = get_post( $post_ID );

	require_once('libraries/tumblroauth/tumblroauth.php');

// Define the needed keys
	$consumer_key = "wzhr9lOEWDndxybztr6sTWCtp02a1fJiCp6B3WYaa9Xa2q4Wtz";
	$consumer_secret = "umXBveWpQnKId3Q7qQTS46UDUQ13IPcmmNhmbvGrsi8t4SclRj";
	$oauth_token = "MVQwyj4p6M7dP9tbK43kJst6oswQTCmvfB47CClkoNOhIcRvBg";
	$oauth_secret = "PC491jw1tWKmQVbj2vK5g6Tqu0oT8Nw4tB0QEmcHkysxW4FZOO";

	$post_id = $post->ID;
	$shortlink = wp_get_shortlink();
	$text_content = $post->post_content . '<div class="shortlink"><a href="' . $shortlink . '" rel="bookmark">' . $shortlink . '</a></div>';
	$text_content = wpautop($text_content);


// ...run code once
	if ( !get_post_meta( $post_id, 'tumbled', $single = true ) ) {

		$tum_oauth = new TumblrOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_secret);

		if ( get_post_format( $post->ID ) == 'audio' ) {

			$audio_url = audio_yoink( $post->post_content );

			$tumble_this = $tum_oauth->post('http://api.tumblr.com/v2/blog/edbury.tumblr.com/post', array(
				'type' => 'audio', 
				'caption' => $text_content,
				'external_url' => $audio_url
				)
			);
			
		} else {

			$tumble_this = $tum_oauth->post('http://api.tumblr.com/v2/blog/edbury.tumblr.com/post', array(
				'type' => 'text', 
				'body' => $text_content,
				'title' => $post->post_title
				)
			);

		}

		if ( 200 == $tum_oauth->http_code | 201 == $tum_oauth->http_code ) {
			update_post_meta( $post_id, 'tumbled', true );
		} else {
			error_log('posse_tumblr()) error' . $code);
		}

	}
}


add_action( 'xmlrpc_publish_post', 'posse_tumblr' ); 
add_action( 'app_publish_post', 'posse_tumblr' );
add_action( 'publish_post', 'posse_tumblr' );

?>