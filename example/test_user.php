<?php
/**
* @package     /example/test_oauth
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.16
**/

require_once(__DIR__."/../vendor/autoload.php");
use Jue\Server;

/**
* 
*/
$app_key = "testclient";
$app_secret = "testpass";

$server = new Server($app_key, $app_secret);
$oauth_type_client_credentials = $server->auth->get_access_token("client_credentials");
$oauth_type_password = $server->auth->get_access_token("password");

echo json_encode($_SESSION);
