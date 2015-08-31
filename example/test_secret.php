<?php
/**
* @package     /example/test_secret
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.08.25
**/

require_once(__DIR__."/../vendor/autoload.php");

use Jue\Auth;
use Jue\Server;
use Jue\Storage\Memory;

$server = new Server();
$client = $server->secret->portal(1);
echo json_encode($server->get_user_info(1));

//print_r($oauth_type_client_credentials);

//$oauth_type_password = $server->auth()->get_access_token("password");
//$data = $server->secret()->portal("1", "api.jue.so", md5(time()));
//print_r($data);

?>