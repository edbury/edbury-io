<?php

/**
 * Tweets a message from the user whose user token and secret you use.
 *
 * Although this example uses your user token/secret, you can use
 * the user token/secret of any user who has authorised your application.
 *
 * Instructions:
 * 1) If you don't have one already, create a Twitter application on
 *      https://dev.twitter.com/apps
 * 2) From the application details page copy the consumer key and consumer
 *      secret into the place in this code marked with (YOUR_CONSUMER_KEY
 *      and YOUR_CONSUMER_SECRET)
 * 3) From the application details page copy the access token and access token
 *      secret into the place in this code marked with (A_USER_TOKEN
 *      and A_USER_SECRET)
 * 4) Include a reference to this in your functions.php file
 *
 * @author themattharris
 */


function posse_twitter( $post_ID ) {
	$post = get_post( $post_ID );
	// check post format if necessary
	if ( get_post_format( $post->ID ) != 'status' ) return;

	$post_id = $post->ID;
	$shortlink = wp_get_shortlink();
	$tweet_content = $post->post_content.' '.$shortlink;

	

	// ...run code once
	if ( !get_post_meta( $post_id, 'tweeted', $single = true ) ) {


		// require the relevant libraries
		require get_template_directory() .'/inc/posse/libraries/tmhOAuth/tmhOAuth.php';
		require get_template_directory() .'/inc/posse/libraries/tmhOAuth/tmhUtilities.php';
		$tmhOAuth = new tmhOAuth(array(
			'consumer_key'    => 'SdRONQAbY4LeKAvsrK3A',
			'consumer_secret' => 'S1G6nDBMIYEFkfZVO9A2nVqLPCJO8coXJgJ6MzZ2xXM',
			'user_token'      => '771746-sG8SHcbAW8UPFvZkAn6s424WRV19CVMHw46WB02I',
			'user_secret'     => 'Gqiu2hnbyj4MkA7qD4ffeiKTODak8V0pp7fqvNEvp0',
			));


		// Check to see if this is a tweet with image
		if ( has_post_thumbnail( $post_id ) ) {

			$image = str_replace( get_bloginfo('wpurl'), '/var/www/edburyio/wordpress', wp_get_attachment_url( get_post_thumbnail_id($post_id) ));

			error_log($image);

			$code = $tmhOAuth->request(
			  'POST',
			  'http://upload.twitter.com/1/statuses/update_with_media.json',
			  array(
			    'media[]'  => "@{$image};type=image/jpeg;filename={$image}",
			    'status'   => $tweet_content
			  ),
			  true, // use auth
			  true  // multipart
			);

		} else {

			$code = $tmhOAuth->request('POST', $tmhOAuth->url('1/statuses/update'), array(
				'status' => $tweet_content
				));
		}

		if ( $code == 200) {
			error_log('posse_twitter() made it past tmhOAuth, should be on Twitter now');
			update_post_meta( $post_id, 'tweeted', true );
		} else {
			error_log('posse_twitter() error' . $code);
		}

	}
}

add_action( 'xmlrpc_publish_post', 'posse_twitter' ); 
add_action( 'app_publish_post', 'posse_twitter' );
add_action( 'publish_post', 'posse_twitter' );
