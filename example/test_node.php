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

/**
* 
*/
$app_key = "testclient";
$app_secret = "testpass";

$server = new Server($app_key, $app_secret);
$user = $server->get_user_info(1);

if($user["code"] == 1000){
	$user = $user["data"];
	//$list_directory =  $server->list_directory($user["uuid"], $nid=$user["root"], $limit=rand(1, 500), $offset=0);
	//$list_app_directory =  $server->list_directory($user["uuid"], $limit=rand(1, 10), $offset=0);
	//$list_root_directory =  $server->list_directory($user["uuid"], $limit=rand(1, 500), $offset=0);
	
	//$list_node = $server->node->list_node($user["uuid"], $nid=2, $limit=rand(1, 10), $offset=0);
	
	//$reanme_node = $server->node->rename_node($user["uuid"], $nid=191, $name="妹子你叫什么");
	//$add_node = $server->node->add_node($user["uuid"], $pid=2, $name="妹子你叫什么");
	
	//echo json_encode($list_node);
}else{
	//connect platform error
	echo json_encode($user);
}
