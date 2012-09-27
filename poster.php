<?php
// See: https://developer.mozilla.org/En/HTTP_access_control
// See: http://hacks.mozilla.org/2009/07/cross-site-xmlhttprequest-with-cors/
/* header('Access-Control-Allow-Origin: *'); // for X domain ajax requests

error_reporting(E_ALL & ~E_NOTICE); // for development
ini_set('display_errors', '1'); // show errors, remove when deployed
//echo 'asdf';exit;
function cruder($_url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
	$res = curl_exec($ch);
	curl_close($ch);
	return $res;
}
echo cruder(urldecode($_REQUEST['url'])); */

//echo deproxyURL('Y7KsStbwpNgkPx7AUOwMVf02f%2BeEdLm3xhbhTiqdFuVBLSblz%2FOFtJv2gZZWRV1lyA%3D%3D');
header('Access-Control-Allow-Origin: *'); // for X domain ajax requests

//set POST variables
$url = 'http://dopiaza.org/tools/datauri/';
extract($_GET);

// See: http://www.html-form-guide.com/php-form/php-form-submit.html
//create array of data to be posted
$post_data['url'] = 'http://i998.mangareader.net/naruto/602/naruto-3597787.jpg';
$post_data['datasource'] = 'url';
$post_data['base64'] = 'base64';
$post_data['Submit'] = 'Generate Data URI';

//traverse array and prepare data for posting (key1=value1)
foreach ( $post_data as $key => $value) {
    $post_items[] = $key . '=' . $value;
}
//create the final string to be posted using implode()
$post_string = implode ('&', $post_items);
//create cURL connection
$curl_connection =
  curl_init($url);
//set options
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT,
  "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
//set data to be posted
curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string); 
//perform our request
$result = curl_exec($curl_connection);
//show information regarding the request
//print_r(curl_getinfo($curl_connection));
//echo curl_errno($curl_connection) . '-' .curl_error($curl_connection);
//close the connection
curl_close($curl_connection);

echo $result; 
?>