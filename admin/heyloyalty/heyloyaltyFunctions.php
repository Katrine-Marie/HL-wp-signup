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









echo '<div style="font-family:sans-serif;">';
echo '<h2>Thanks for signing up</h2>';
echo '<p>We look forward to sending you our next newsletter.</p>';
echo '</div>';
