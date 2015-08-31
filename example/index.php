<?php

require_once(__DIR__."/../vendor/autoload.php");
use Jue\Server;

$server = new Server();
$client = $server->secret->portal(1);

$user = $server->get_user_info(1);

if($user["code"] == 1000){
	$user = $user["data"];
	//$list_directory =  $server->list_directory($user["uuid"], $user["root"], rand(1, 500), 0);
	$list_node = $server->node->list_node($user["uuid"], 2, rand(1, 29), 0);
	//$reanme_node = $server->node->rename_node($user["uuid"], 191, "妹子你叫什么");
	//$add_node = $server->node->add_node($user["uuid"], 2, "妹子你叫什么");
	echo json_encode($list_node);
}else{

}
