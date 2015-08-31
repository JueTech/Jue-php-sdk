<?php
/**
* @package     /src/Jue/Depot/Node
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.08.31
**/
 
namespace Jue\Depot;

use Jue;
use Jue\Config;
use Jue\Http\Client;
use Jue\Storage\Memory;

class Node implements NodeInterface{

	function __construct(){
		$this->memory = new Memory("node");
	}

	/**
	 * list user root, include node, support for waterfall
	 * @param	string	$limit 		int 	=> select limit
	 * @param	string	$offset  	int 	=> select offset
	 * @param	string	$no_cookie  bool 	=> save cookie
	 * @return 	array 	for waterfall => array(data, current, count) || for select all => array(node, file, current, count)
	 */
	public function list_directory($uuid, $nid, $limit="", $offset=""){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"nid" => $nid,
			"limit" => $limit,
			"offset" => $offset
		);

		$url = Config::API_RESOURCE."/node/list_directory";
		$response = Client::post($url, $data, array());
		//save cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			if($body["code"] == 1000){
				$this->memory->setCache("node".$uuid);
				$this->memory->store("{$uuid}_list_directory_{$nid}_{$limit}_{$offset}", $body, Config::EXPIRED_SHORT);
			}
			return $body;
		}

		return $this->do_result($response);
	}

	/**
	 * list user root, include file and node, support for waterfall
	 * @param	string	$limit 		int 	=> select limit
	 * @param	string	$offset  	int 	=> select offset
	 * @param	string	$no_cookie  bool 	=> save cookie
	 * @return 	array 	for waterfall => array(data, current, count) || for select all => array(node, file, current, count)
	 */
	public function list_root_directory($uuid, $limit="", $offset=""){
		$data = array(
			"access_token" => ACCESS_TOKEN, 
			"uuid" => $uuid,
			"limit" => $limit,
			"offset" => $offset
		);

		$url = Config::API_RESOURCE."/node/list_root_directory";
		$response = Client::post($url, $data, array());
		//save cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			if($body["code"] == 1000){
				$this->memory->setCache("node".$uuid);
				$this->memory->store("{$uuid}_list_root_directory_{$limit}_{$offset}", $body, Config::EXPIRED_SHORT);
			}
			return $body;
		}

		return $this->do_result($response);
	}

	/**
	 * list user app, include file and node, support for waterfall
	 * @param	string	$client_id  String 	=> develop client id
	 * @param	string	$limit 		int 	=> select limit
	 * @param	string	$offset  	int 	=> select offset
	 * @param	string	$no_cookie  bool 	=> save cookie
	 * @return 	array 	for waterfall => array(data, current, count) || for select all => array(node, file, current, count)
	 */
	public function list_app_directory($uuid, $limit="", $offset=""){
		$data = array(
			"client_id"	=> ACCESS_KEY,
			"access_token" => ACCESS_TOKEN, 
			"uuid" => $uuid,
			"limit" => $limit,
			"offset" => $offset
		);

		$url = Config::API_RESOURCE."/node/list_app_directory";
		$response = Client::post($url, $data, array());
		//save cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			if($body["code"] == 1000){
				$this->memory->setCache("node".$uuid);
				$this->memory->store("{$uuid}_list_app_directory_{$limit}_{$offset}", $body, Config::EXPIRED_SHORT);
			}
			return $body;
		}
		return $this->do_result($response);
	}

	/**
	 * rename node
	 * @param	int		$nid		node id
	 * @param	string	$name 		new name
	 * @return 	array 	array("true/false")	boolean
	*/
	public function rename_node($uuid, $nid, $name){
		$data = array(
			"access_token" => ACCESS_TOKEN, 
			"uuid" => $uuid,
			"nid" => $nid,
			"name" => $name,
		);

		$url = Config::API_RESOURCE."/node/rename_node";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	/**
	 * add node
	 * @param	int		$pid		int 	=> node id
	 * @param	string	$name 		string 	=> node name
	 * @return 	array 	array("id")	=> insert id
	*/
	public function add_node($uuid, $pid, $name){
		$data = array(
			"access_token" => ACCESS_TOKEN, 
			"uuid" => $uuid,
			"pid" => $pid,
			"name" => $name,
		);

		$url = Config::API_RESOURCE."/node/add_node";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	/**
	 * list node, include node, support for waterfall
	 * @param	int		$nid		int 	=> node id
	 * @param	string	$limit 		int 	=> select limit
	 * @param	string	$offset  	int 	=> select offset
	 * @param	string	$no_cookie  bool 	=> save cookie
	 * @return 	array 	for waterfall => array(data, current, count) || for select all => array(node, file, current, count)
	*/
	public function list_node($uuid, $nid, $limit="", $offset=""){
		$data = array(
			"access_token" => ACCESS_TOKEN, 
			"uuid" => $uuid,
			"nid" => $nid,
			"limit" => $limit,
			"offset" => $offset
		);

		$url = Config::API_RESOURCE."/node/list_node";
		$response = Client::post($url, $data, array());
		//save cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			if($body["code"] == 1000){
				$this->memory->setCache("node".$uuid);
				$this->memory->store("{$uuid}_list_node_{$nid}_{$limit}_{$offset}", $body, Config::EXPIRED_SHORT);
			}
			return $body;
		}
		return $this->do_result($response);
	}

	/**
	 * list user app root, only include node, support for waterfall
	 * @param	string	$limit 		int 	=> select limit
	 * @param	string	$offset  	int 	=> select offset
	 * @return 	array 	for select all => array("count", "node", "file", "current") || for waterfall => array("count", "data", "app")
	 */
	public function list_app(){
		$data = array(
			"client_id"	=> ACCESS_KEY,
			"access_token" => ACCESS_TOKEN, 
			"uuid" => $uuid,
			"limit" => $limit,
			"offset" => $offset
		);

		$url = Config::API_RESOURCE."/node/list_app";
		$response = Client::post($url, $data, array());
		//save cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			if($body["code"] == 1000){
				$this->memory->setCache("node".$uuid);
				$this->memory->store("{$uuid}_list_app_{$limit}_{$offset}", $body, Config::EXPIRED_SHORT);
			}
			return $body;
		}
		return $this->do_result($response);
	}

	public function list_file($uuid, $nid){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"nid" => $nid,
		);

		$url = Config::API_RESOURCE."/node/list_file";
		$response = Client::post($url, json_encode($data), array("Content-Type" => "application/json"));
		return $this->do_result($response);
	}

	public function get_node($uuid, $nid){	
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"nid" => $nid,
		);

		$url = Config::API_RESOURCE."/node/get_node";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	private function do_result($response){		
		//save cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			return $body;
		}
		if ($response->json() != null) {
            return array($response->json(), null);
        }
        return array($response->body, null);
	}
}









