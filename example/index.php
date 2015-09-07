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

$server = new Server();//default use config.php
$user = $server->get_user_info(1);

if($user["code"] == 1000){
	$user = $user["data"];

	/*-------------------------------node-------------------------------*/

	//$list_directory =  $server->node->list_directory($user["uuid"], $nid=$user["root"], $limit=500, $offset=0); echo json_encode($list_directory);
	//$list_app_directory =  $server->node->list_app_directory($user["uuid"], $limit=rand(1, 10), $offset=0); echo json_encode($list_app_directory);
	//$list_root_directory =  $server->node->list_root_directory($user["uuid"], $limit=rand(1, 500), $offset=0); echo json_encode($list_root_directory);
	
	//$list_node = $server->node->list_node($user["uuid"], $nid=2, $limit=rand(1, 10), $offset=0); echo json_encode($list_node);
	
	//$reanme_node = $server->node->rename_node($user["uuid"], $nid=191, $name="妹子你叫什么"); echo json_encode($reanme_node);
	//$add_node = $server->node->add_node($user["uuid"], $pid=2, $name="妹子你叫什么"); echo json_encode($add_node);
	//$list_app_image_file_with_thumb = $server->node->list_app_image_file_with_thumb($user["uuid"], $limit=rand(1, 999), $offset=0, $format="/2/w/1024/h/1024/q/90"); echo json_encode($list_app_image_file_with_thumb);

	/*-------------------------------file------------------------------*/
	
	//$copy_files_to_app = $server->file->copy_files_to_app($user["uuid"], $fids = array(3,4,6,2576)); echo json_encode($copy_files_to_app);
	//$delete_files = $server->file->delete_files($user["uuid"], $fids = array(2576)); echo json_encode($delete_files);
	//$move_files_to_app = $server->file->move_files_to_app($user["uuid"], $fids = array(2576)); echo json_encode($move_files_to_app);
	//$get_file =  $server->file->get_file($user["uuid"], $fid=3); echo json_encode($get_file);
	//$copy_files =  $server->file->copy_files($user["uuid"], $fids=json_encode(array(2220, 1241)), $to_nid=191); echo json_encode($copy_files);
	//$rename_file =  $server->file->rename_file($user["uuid"], $fid=2220, $name="这是新名字"); echo json_encode($rename_file);
	//$batch_move_to_root = $server->file->batch_move_to_root($user["uuid"], $ids = json_encode(array(2222, 58))); echo json_encode($batch_move_to_root);
	//$batch_move_to_node = $server->file->batch_move_to_node($user["uuid"], $ids = json_encode(array(array(2222, 2220), array())), $to_nid = 3); echo json_encode($batch_move_to_node);
	//$get_thumb_url = $server->file->get_thumb_url($user["uuid"], $id = 2222, "/2/w/8/h/8/q/10"); echo json_encode($get_thumb_url);
	//$redirect_thumb = $server->file->redirect_thumb($user["uuid"], $id = 2222, "/2/w/1024/h/1024/q/100");
	//$batch_get_thumb_url = $server->file->batch_get_thumb_url($user["uuid"], $fids = array(2222, 1376), "/2/w/1024/h/1024/q/90"); echo json_encode($batch_get_thumb_url);
	
	/*-------------------------------cloud------------------------------*/
	//$get_upload_token = $server->cloud->get_upload_token($user["uuid"], $save_to_root=false, $parent=""); echo json_encode($get_upload_token); //default parent is app root

	/*-------------------------------user------------------------------*/
	//$get_user_info = $server->user->get_user_info($user["uuid"]); echo json_encode($get_user_info);

	/*-------------------------------search------------------------------*/
	//$search = $server->search->search_key($user["uuid"], $key=".jpg", $limit=25, $offset=0); echo json_encode($search);
	//$search_image = $server->search->search_image($user["uuid"], $format="/2/w/256/h/256/q/85/interlace/0", $limit=25, $offset=0); echo json_encode($search_image);
	//$search_doc = $server->search->search_doc($user["uuid"], $limit=10, $offset=0); echo json_encode($search_doc);
	//$search_video = $server->search->search_video($user["uuid"], $limit=25, $offset=0); echo json_encode($search_video);
	//$search_source = $server->search->search_source($user["uuid"], $limit=25, $offset=0); echo json_encode($search_source);
	
}else{
	//connect platform error
	echo json_encode($user);
}
