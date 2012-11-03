<?php

require("libraries/tumblr-api/defaults.php");
require("libraries/tumblr-api/autoloader.php");

Tumblr\API::configure(BASE_HOSTNAME, API_KEY, API_SECRET);
Tumblr\API::authenticate(TOKEN, TOKEN_SECRET);

//var_dump(Tumblr\API::getPosts());

$cls = new Tumblr\Post\Text();
$cls->title = "A Test";
$cls->body = "Sending this from php.";

var_dump($cls->serialize());

var_dump(Tumblr\API::submitPost($cls, "off"));

