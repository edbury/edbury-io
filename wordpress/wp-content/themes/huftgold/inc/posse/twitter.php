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
 * 4) Visit this page using your web browser.
 *
 * @author themattharris
 */


function posse_twitter( $post_ID ) {
	global $post;
	// check post type if necessary
    if ( get_post_format( $post->ID ) != 'status' ) return;

    $post_id = $post->ID;
    $tweet_content = $post->post_content;

    if ( !get_post_meta( $post_id, 'tweeted', $single = true ) ) {
        // ...run code once
		require 'libraries/tmhOAuth/tmhOAuth.php';
		require 'libraries/tmhOAuth/tmhUtilities.php';
		$tmhOAuth = new tmhOAuth(array(
		  'consumer_key'    => 'SdRONQAbY4LeKAvsrK3A',
		  'consumer_secret' => 'S1G6nDBMIYEFkfZVO9A2nVqLPCJO8coXJgJ6MzZ2xXM',
		  'user_token'      => '771746-sG8SHcbAW8UPFvZkAn6s424WRV19CVMHw46WB02I',
		  'user_secret'     => 'Gqiu2hnbyj4MkA7qD4ffeiKTODak8V0pp7fqvNEvp0',
		));

		$code = $tmhOAuth->request('POST', $tmhOAuth->url('1/statuses/update'), array(
		  'status' => $tweet_content
		));

		update_post_meta( $post_id, 'tweeted', true );
    }
}

add_action( 'publish_post', 'posse_twitter' );
