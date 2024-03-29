<?php

// ini_set('display_errors', 1);
// error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

require 'HL-phpclient/src/HL-phpclient/HLCurlHandler.php';
require 'HL-phpclient/src/HL-phpclient/HLBase.php';
require 'HL-phpclient/src/HL-phpclient/HLClient.php';
require 'HL-phpclient/src/HL-phpclient/HLMembers.php';
require 'HL-phpclient/src/HL-phpclient/HLLists.php';

use Phpclient\HLClient;
use Phpclient\HLMembers;
use Phpclient\HLLists;

$apiKey = base64_decode(urldecode($_GET['access1']));
$apiSecret = base64_decode(urldecode($_GET['access2']));
$listId = base64_decode(urldecode($_GET['list']));

function createHeyloyaltySignup($email, $firstname = null, $lastname = null, $mobile = null){

  if($firstname || $lastname && $mobile){
    $fields = [
      'email' => $email,
  		'firstname' => $firstname,
  		'lastname' => $lastname,
      'mobile' => $mobile
  	];
  }elseif($firstname || $lastname){
    $fields = [
      'email' => $email,
  		'firstname' => $firstname,
  		'lastname' => $lastname
  	];
  }elseif($mobile){
    $fields = [
      'email' => $email,
      'mobile' => $mobile
  	];
  }else {
    $fields = [
      'email' => $email
  	];
  }

  $client = new HLClient($apiKey,$apiSecret);
  $listsService = new HLLists($client);

	$client = new HLClient($apiKey,$apiSecret);
	$memberService = new HLMembers($client);
	$result = $memberService->create($listId,$fields);

}

if(isset($_POST['hl-wp-submit'])){
  $email = htmlspecialchars($_POST['hl-email'], ENT_QUOTES);
  $firstname = htmlspecialchars($_POST['hl-firstname'], ENT_QUOTES);
  $lastname = htmlspecialchars($_POST['hl-lastname'], ENT_QUOTES);
  $mobile = htmlspecialchars($_POST['hl-mobile'], ENT_QUOTES);

  createHeyloyaltySignup($email, $firstname, $lastname, $mobile);
}

echo '<div style="font-family:sans-serif;">';
echo '<h2>Thanks for signing up</h2>';
echo '<p>We look forward to sending you our next newsletter.</p>';
echo '</div>';
