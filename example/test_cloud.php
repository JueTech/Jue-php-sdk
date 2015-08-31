<?php
/**
* @package     /example/test_node
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.16
**/

require_once(__DIR__."/../vendor/autoload.php");
use Jue\Server;
use Jue\Auth\Token;

/**
* 
*/
$app_key = "homeway";
$app_secret = "homeway";

$server = new Server($app_key, $app_secret);
//$oauth = $server->auth()->get_access_token("client_credentials");
//$oauth_type_password = $server->auth()->get_access_token("password");

$user = $server->secret->portal("1", "api.jue.so", md5(time()));
//print_r($user);exit();

$user = json_decode($user, true);

if($user["code"] == 1000){
	$data = $server->cloud->get_upload_token($user["data"]["uuid"]);
	echo json_encode($data);
}