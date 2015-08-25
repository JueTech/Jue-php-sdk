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
$nid = 3;
$uuid = "cf9dc994-a4e7-3ad6-bc54-41965b2a0dd7";

$res_add_node = $server->node()->add_node($uuid, $nid, "hsdafaahahsadadasdada");
$res_list_directory = $server->node()->list_directory($uuid, $nid);
$res_list_file  = $server->node()->list_file($uuid, $nid);
$res_list_node = $server->node()->list_node($uuid, $nid);
$res_get_node = $server->node()->get_node($uuid, $nid);

//get return data by echo json_encode
echo json_encode($res_list_directory);
//echo json_encode($res_list_file);
//echo json_encode($res_list_node);
//echo $res_get_node;
//echo json_encode($res_add_node);