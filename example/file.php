<?php
/**
* @package     /example/file
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.08.31
**/

require_once(__DIR__."/../vendor/autoload.php");
use Jue\Server;

$server = new Server();
$user = $server->get_user_info(1);

if($user["code"] == 1000){
	$user = $user["data"];
	/*-------------------------------file------------------------------*/

	//$get_file =  $server->file->get_file($user["uuid"], $fid=3); echo json_encode($get_file);
	//$copy_files =  $server->file->copy_files($user["uuid"], $fids=json_encode(array(2220, 1241)), $to_nid=191); echo json_encode($copy_files);
	//$rename_file =  $server->file->rename_file($user["uuid"], $fid=2220, $name="这是新名字"); echo json_encode($rename_file);
	//$batch_move_to_root = $server->file->batch_move_to_root($user["uuid"], $ids = json_encode(array(2222, 58))); echo json_encode($batch_move_to_root);
	//$batch_move_to_node = $server->file->batch_move_to_node($user["uuid"], $ids = json_encode(array(array(2222, 2220), array())), $to_nid = 3); echo json_encode($batch_move_to_node);
	//$get_thumb_url = $server->file->get_thumb_url($user["uuid"], $id = 2222, "/2/w/8/h/8/q/10"); echo json_encode($get_thumb_url);
	//$redirect_thumb = $server->file->redirect_thumb($user["uuid"], $id = 2222, "/2/w/1024/h/1024/q/100");
	//$batch_get_thumb_url = $server->file->batch_get_thumb_url($user["uuid"], $fids = array(2222, 1376), "/2/w/1024/h/1024/q/90"); echo json_encode($batch_get_thumb_url);
	
}else{
	//connect platform error
	echo json_encode($user);
}
