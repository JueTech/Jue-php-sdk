# Jue Resource SDK for PHP

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Build Status](https://travis-ci.org/qiniu/python-sdk.svg)](https://github.com/grasses/Jue-php-sdk)
[![Code Coverage](https://scrutinizer-ci.com/g/qiniu/python-sdk/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/qiniu/python-sdk/?branch=master)

<br><hr>

# Installation

**Install composer**

> $ curl -sS https://getcomposer.org/installer | php

or 

> $ php -r "readfile('https://getcomposer.org/installer');" | php

Composer detail see [https://getcomposer.org/doc/00-intro.md](https://getcomposer.org/doc/00-intro.md)

**Install SDK**

> $ composer install grasses/jue-php-sdk

<br><hr>

# Usage

Start new server, get access token.

```
<?php
/**
* @package     /example/test_node
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.09.04
**/

require_once(__DIR__."/../vendor/autoload.php");
use Jue\Server;

$server = new Server();//default use config.php
$user = $server->get_user_info( $_SESSION("user_id"));//connect platform

if($user["code"] == 1000){
	$user = $user["data"];

	/*-------------------------------node-------------------------------*/

	$list_directory =  $server->list_directory($user["uuid"], $nid=$user["root"], $limit=rand(1, 500), $offset=0); echo json_encode($list_directory);
	$list_app_directory =  $server->list_directory($user["uuid"], $limit=rand(1, 10), $offset=0); echo json_encode($list_app_directory);
	$list_root_directory =  $server->list_directory($user["uuid"], $limit=rand(1, 500), $offset=0); echo json_encode($list_root_directory);
	
	$list_node = $server->node->list_node($user["uuid"], $nid=2, $limit=rand(1, 10), $offset=0); echo json_encode($list_node);
	
	$reanme_node = $server->node->rename_node($user["uuid"], $nid=191, $name="妹子你叫什么"); echo json_encode($reanme_node);
	$add_node = $server->node->add_node($user["uuid"], $pid=2, $name="妹子你叫什么"); echo json_encode($add_node);
	$list_app_image_file_with_thumb = $server->node->list_app_image_file_with_thumb($user["uuid"], $limit=rand(1, 999), $offset=0, $format="/2/w/1024/h/1024/q/90"); echo json_encode($list_app_image_file_with_thumb);

	/*-------------------------------file------------------------------*/

	$get_file =  $server->file->get_file($user["uuid"], $fid=3); echo json_encode($get_file);
	$copy_files =  $server->file->copy_files($user["uuid"], $fids=json_encode(array(2220, 1241)), $to_nid=191); echo json_encode($copy_files);
	$rename_file =  $server->file->rename_file($user["uuid"], $fid=2220, $name="这是新名字"); echo json_encode($rename_file);
	$batch_move_to_root = $server->file->batch_move_to_root($user["uuid"], $ids = json_encode(array(2222, 58))); echo json_encode($batch_move_to_root);
	$batch_move_to_node = $server->file->batch_move_to_node($user["uuid"], $ids = json_encode(array(array(2222, 2220), array())), $to_nid = 3); echo json_encode($batch_move_to_node);
	$get_thumb_url = $server->file->get_thumb_url($user["uuid"], $id = 2222, "/2/w/8/h/8/q/10"); echo json_encode($get_thumb_url);
	$redirect_thumb = $server->file->redirect_thumb($user["uuid"], $id = 2222, "/2/w/1024/h/1024/q/100");
	$batch_get_thumb_url = $server->file->batch_get_thumb_url($user["uuid"], $fids = array(2222, 1376), "/2/w/1024/h/1024/q/90"); echo json_encode($batch_get_thumb_url);
	
	/*-------------------------------cloud------------------------------*/
	$get_upload_token = $server->cloud->get_upload_token($user["uuid"], $save_to_root=false, $parent=""); echo json_encode($get_upload_token); //default parent is app root

	/*-------------------------------user------------------------------*/
	$get_user_info = $server->user->get_user_info($user["uuid"]); echo json_encode($get_user_info);

	/*-------------------------------search------------------------------*/
	$search = $server->search->search_key($user["uuid"], $key=".jpg", $limit=25, $offset=0); echo json_encode($search);
	$search_image = $server->search->search_image($user["uuid"], $format="/2/w/256/h/256/q/85/interlace/0" $limit=25, $offset=0); echo json_encode($search_image);
	$search_doc = $server->search->search_doc($user["uuid"], $limit=25, $offset=0); echo json_encode($search_doc);
	$search_video = $server->search->search_video($user["uuid"], $limit=25, $offset=0); echo json_encode($search_video);
	$search_source = $server->search->search_source($user["uuid"], $limit=25, $offset=0); echo json_encode($search_source);
	
}else{
	//connect platform error
	echo json_encode($user);
}

```

Get Node info, for more api information please see [http://api.jue.so/doc/](http://api.jue.so/doc/)


return json format data. 


<br><hr>

# Associate

Jue API please see [http://api.jue.so/doc/](http://api.jue.so/doc/)

Jue API test platform please see [http://api.jue.so/oauth2/api](http://api.jue.so/oauth2/api)

Jue Oauth platoform please see [http://homeway.me/2015/06/29/build-oauth2-under-codeigniter/](http://homeway.me/2015/06/29/build-oauth2-under-codeigniter/)

<br><hr>

# License

This library is under the MIT license. For the full copyright and license information, please view the LICENSE file that was distributed with this source code.

[https://github.com/JueTech/Jue-php-sdk/blob/dev/LICENSE](https://github.com/JueTech/Jue-php-sdk/blob/dev/LICENSE)
