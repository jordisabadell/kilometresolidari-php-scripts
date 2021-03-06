<?php
//https://twitteroauth.com/
require_once __DIR__ . '/../vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
 
//https://developer.twitter.com/en/apps
define('CONSUMER_KEY', '${CONSUMER_KEY}');
define('CONSUMER_SECRET', '${CONSUMER_SECRET}');
define('ACCESS_TOKEN', '${ACCESS_TOKEN}');
define('ACCESS_TOKEN_SECRET', '${ACCESS_TOKEN_SECRET}');

$conn = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

$query = array(
 "q" => "#Sabadell" //#kmsolidari
);
$tweets = $conn->get('search/tweets', $query);
echo "searching...";
$data = array();
foreach ($tweets->statuses as $tweet) {

	$post = array('created_at' => $tweet->created_at,
		'text' => $tweet->text,
		'user_name' => $tweet->user->screen_name ,
		'user_avatar' => $tweet->user->profile_image_url,
		'user_location' => $tweet->user->location);

	array_push($data, $post);	
}

$json = json_encode($data);

$file = fopen("../data/tweets.json", "w");
fwrite($file, $json);
echo "done";
?>