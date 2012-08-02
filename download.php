<?php 
/**/
error_reporting(E_ALL & ~E_NOTICE); // for development 
ini_set('display_errors', '1'); // show errors, remove when deployed
/**/

set_time_limit(0);

// grab the requested file's name

if (!isset($_GET['file'])) {
	echo 'no file';
	exit;
}

function cruder($_url) {
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
	$res = curl_exec($ch);
	curl_close($ch);
	return $res;
}

$file_name = $_GET['file'];

header('Pragma: public'); 	// required
header('Expires: 0');		// no cache
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

header('Cache-Control: private',false);
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
//header('Content-Transfer-Encoding: binary');
//header('Content-Length: '.filesize($file_name));	// provide file size
//header('Connection: close');
echo cruder($file_name);		// push it out
exit();

?>