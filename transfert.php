<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

$followFileName = 'followId.csv';
$configIn = parse_ini_file('configIn.ini');
$confiOut = parse_ini_file('configOut.ini');

$connectionIn = new TwitterOAuth($configIn['consumer_key'],$configIn['consumer_secret'], $configIn['access_token'], $configIn['access_token_secret']);

$connectionOut = new TwitterOAuth($confiOut['consumer_key'],$confiOut['consumer_secret'], $confiOut['access_token'], $confiOut['access_token_secret']);


$friendsId = $connectionOut->get("friends/ids");

echo 'You follow '.sizeof($friendsId->ids).'<br>';

if (!file_exists($followFileName)) {
	$file = fopen($followFileName, 'w');
	foreach ($friendsId->ids as $key => $value) {
		fputcsv($file,array($value));
    }
    fclose($file);
}
else{
	$friends= array_map('str_getcsv', file($followFileName));
	foreach ($friends as $key => $value) {
		$status =$connectionIn->post("friendships/create", ['user_id'=>$value[0]]);	
		echo print_r($status);
	}
}

$friendsId = $connectionIn->get("friends/ids");

echo 'You follow '.sizeof($friendsId->ids).'<br>';


?>