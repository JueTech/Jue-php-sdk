<?php
/**
* @package     /src/Jue/Storage/Node
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/
 
namespace Jue\Storage;

use Jue;
use Jue\Config;
use Jue\Auth\Token;
use Jue\Http\Request;
use Jue\Http\Client;
use Jue\Http\Error;
use Jue\Http\Response;

class Node implements NodeInterface{

	function __construct(){
		$TokenClass = new Token();
		$this->access_token = $TokenClass->get_access_token();
	}

	public function add_node($uuid, $pid, $name){
		$data = array(
			"access_token" => $this->access_token, 
			"uuid" => $uuid,
			"pid" => $pid,
			"name" => $name,
		);

		$url = Config::API_RESOURCE."/node/add_node";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	public function list_file($uuid, $nid){
		$data = array(
			"access_token" => $this->access_token, 
			"uuid" => $uuid,
			"nid" => $nid,
		);

		$url = Config::API_RESOURCE."/node/list_file";
		$response = Client::post($url, json_encode($data), array());
		return $this->do_result($response);
	}

	public function list_directory($uuid, $nid){
		$data = array(
			"access_token" => $this->access_token, 
			"uuid" => $uuid,
			"nid" => $nid,
		);

		$url = Config::API_RESOURCE."/node/list_directory";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	public function list_node($uuid, $nid){	
		$data = array(
			"access_token" => $this->access_token, 
			"uuid" => $uuid,
			"nid" => $nid,
		);

		$url = Config::API_RESOURCE."/node/list_node";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	public function get_node($uuid, $nid){	
		$data = array(
			"access_token" => $this->access_token, 
			"uuid" => $uuid,
			"nid" => $nid,
		);

		$url = Config::API_RESOURCE."/node/get_node";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	private function do_result($response){
		if($response->ok()){
			return $response->body;
		}
		if ($response->json() != null) {
            return array($response->json(), null);
        }
        return array($response->body, null);
	}
}









