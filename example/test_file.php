<?php
/**
* @package     /example/test_node
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.16
**/

require_once(__DIR__."/../lib/vendor/autoload.php");
use Jue\Server;

/**
* 
*/
$app_key = "testclient";
$app_secret = "testpass";

$server = new Server($app_key, $app_secret);
$oauth = $server->auth()->get_access_token("client_credentials");

//define variable
$fid = 3;
$uuid = "cf9dc994-a4e7-3ad6-bc54-41965b2a0dd7";

$res_share_file = $server->file()->share_file($uuid, $fid);
$res_delete_file  = $server->file()->delete_file($uuid, 12345);
$res_delete_files = $server->file()->delete_files($uuid, "121,122,123,124,125,126,127,128");

$to_node_id = 3;
$res_move_file = $server->file()->move_file($uuid, $to_node_id, $fid);

$res_move_files = $server->file()->move_files($uuid, $to_node_id, "121,122,123,124,125,126,127,128");

$res_get_file = $server->file()->get_file($uuid, $fid);
$res_rename_file = $server->file()->rename_file($uuid, "new_name", $fid);

//get return data by echo json_encode
//echo json_encode($res_share_file);
//echo json_encode($res_delete_file);
//echo json_encode($res_delete_files);
//echo json_encode($res_move_file);
//echo json_encode($res_move_files);
echo json_encode($res_get_file);
//echo json_encode($res_rename_file);

