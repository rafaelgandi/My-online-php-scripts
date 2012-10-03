<?php 
// See: https://developer.mozilla.org/En/HTTP_access_control
// See: http://hacks.mozilla.org/2009/07/cross-site-xmlhttprequest-with-cors/
header('Access-Control-Allow-Origin: *'); // for X domain ajax requests

error_reporting(E_ALL & ~E_NOTICE); // for development 
ini_set('display_errors', '1'); // show errors, remove when deployed

function cruder($_url) {
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
	$res = curl_exec($ch);
	curl_close($ch);
	return $res;
}
if (isset($_REQUEST['encoded'])) {
	echo cruder(base64_decode(urldecode($_REQUEST['url'])));
}
else {
	echo cruder(urldecode($_REQUEST['url']));
}

 
?>





