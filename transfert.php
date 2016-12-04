<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

$configIn = parse_ini_file('configIn.ini');
$confiOut = parse_ini_file('configOut.ini');

$connectionIn = new TwitterOAuth($configIn['consumer_key'],$configIn['consumer_secret'], $configIn['access_token'], $configIn['access_token_secret']);
$connectionOut = new TwitterOAuth($confiOut['consumer_key'],$confiOut['consumer_secret'], $confiOut['access_token'], $confiOut['access_token_secret']);


?>