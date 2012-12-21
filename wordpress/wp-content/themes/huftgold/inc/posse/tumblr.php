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
	if ( $post->post_title != '' ) {
		$video_content = '<p class="caption">' . $post->post_title . '</p>' . $text_content;
	} else {
		$video_content = $text_content;
	}
	$text_content = wpautop($text_content);
	$video_content = wpautop($video_content);
	$safe_title = htmlspecialchars($post->post_title);
	$tags = get_the_tags( $post_id );
	if ($tags) {
	  foreach($tags as $tag) {
	    $tag_array[] = $tag->name ; 
	  }
	  $tag_string = implode(',', $tag_array);
	} else {
		$tag_string = '';
	}
	if ( has_post_thumbnail($post_id) ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
		$image_url = $image['0'];
		$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full-size' );
		$full_image = $fullsize['0'];
		$photo_content = '<p><a href="' . $full_image . '"><img src="' . $image_url . '" alt="' . $safe_title . '" title="' . $safe_title . '"></a></p>';
		$photo_content = $photo_content . $text_content;
	}

// ...run code once
	if ( !get_post_meta( $post_id, 'tumbled', $single = true ) ) {

		$tum_oauth = new TumblrOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_secret);

		if ( get_post_format( $post->ID ) == 'audio' ) {

			$audio_url = link_yoink( $post->post_content );

			$tumble_this = $tum_oauth->post('http://api.tumblr.com/v2/blog/edbury.tumblr.com/post', array(
				'type' => 'audio', 
				'tags' => $tag_string,
				'caption' => $text_content,
				'external_url' => $audio_url
				)
			);
		
		} else if ( get_post_format( $post->ID ) == 'link' ) {

			$link_url = link_yoink( $post->post_content );
			
			$tumble_this = $tum_oauth->post('http://api.tumblr.com/v2/blog/edbury.tumblr.com/post', array(
				'type' => 'link', 
				'tags' => $tag_string,
				'description' => $text_content,
				'url' => $link_url,
				'title' => $safe_title
				)
			);

		} else if ( get_post_format( $post->ID ) == 'video' ) {

			$embed = get_post_meta($post->ID, 'video', true);
			
			$tumble_this = $tum_oauth->post('http://api.tumblr.com/v2/blog/edbury.tumblr.com/post', array(
				'type' => 'video', 
				'tags' => $tag_string,
				'caption' => $video_content,
				'embed' => $embed,
				)
			);

		} else if ( ( get_post_format( $post->ID ) == 'image' ) || ( ( get_post_format( $post->ID ) == 'status' ) && ( has_post_thumbnail( $post->ID ) ) ) )  {

			$tumble_this = $tum_oauth->post('http://api.tumblr.com/v2/blog/edbury.tumblr.com/post', array(
				'type' => 'text', 
				'tags' => $tag_string,
				'body' => $photo_content,
				'title' => $safe_title
				)
			);

		} else {

			$tumble_this = $tum_oauth->post('http://api.tumblr.com/v2/blog/edbury.tumblr.com/post', array(
				'type' => 'text', 
				'tags' => $tag_string,
				'body' => $text_content,
				'title' => $safe_title
				)
			);

		}

		if ( 200 == $tum_oauth->http_code | 201 == $tum_oauth->http_code ) {
			update_post_meta( $post_id, 'tumbled', true );
		} else {
			error_log('posse_tumblr()) error' . $tum_oauth->http_code . print_r($tum_oauth, true));
		}

	}
}


add_action( 'xmlrpc_publish_post', 'posse_tumblr' ); 
add_action( 'app_publish_post', 'posse_tumblr' );
add_action( 'publish_post', 'posse_tumblr' );

?>