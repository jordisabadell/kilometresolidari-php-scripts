<?php
$q = filter_input(INPUT_POST, 'q', FILTER_SANITIZE_STRING);
$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

if(!$token){
  echo 'Error: token is empty.';
  exit;
}

$secretKey = "${APIKERECATCHA_SECRET}";
$ip = $_SERVER['REMOTE_ADDR'];

$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
  'response' => $token,
  'secret' => $secretKey);

$options = array(
  'http' => array(
    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
    'method'  => 'POST',
    'content' => http_build_query($data)
  )
);

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$responseKeys = json_decode($response, true);

header('Content-type: application/json');
if($responseKeys["success"]) {
  echo json_encode(array('success' => 'true'));
} else {
  echo json_encode(array('success' => 'false'));
}
?>