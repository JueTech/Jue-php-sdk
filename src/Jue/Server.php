<?php
/**
* @package     /src/Jue/Server
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.08.31
**/

namespace Jue;
 
use Jue;
use Jue\Config;
use Jue\Depot\File;
use Jue\Depot\Node;
use Jue\Depot\User;
use Jue\Depot\Secret;
use Jue\Depot\Cloud;
use Jue\Depot\Search;
use Jue\Auth\Auth;
use Jue\Http\Client;
use Jue\Storage\Memory;

class Server{
	function __construct($access_key = Config::ACCESS_KEY, $access_secret = Config::ACCESS_SECRET) {
		define("ACCESS_KEY", $access_key);
		define("ACCESS_SECRET", $access_secret);
		
		$this->auth = new Auth();
		$this->memory = new Memory("auth");
		
		$this->memory->eraseExpired();
		if(!$oauth = $this->memory->retrieve("auth")) {
			$this->auth->get_access_token("password");
			$oauth = $this->memory->retrieve("auth");
		}
		
		define("ACCESS_TOKEN", $oauth["access_token"]);

		//start new class
		$this->cloud = new Cloud();
		$this->secret = new Secret();
		$this->file = new File();
		$this->node = new Node();
		$this->user = new User();
		$this->search = new Search();
	}

	/**
	* list directory by cache, if post limit && offset, support for waterfall, esle select all. 
	* if no cache return node()->list_directory()
	* @param 	String 	user uuid
	* @param 	int 	node id
	* @return 	array 	for waterfall => array(data, current, count) || for select all => array(node, file, current, count)
	*/
	public function list_directory($uuid, $nid, $limit="", $offset=""){
		$this->memory->setCache("node".$uuid);
		$this->memory->eraseExpired();
		if(!$directory_info = $this->memory->retrieve($uuid."_list_directory_".$limit."_".$offset)) {
			return $this->get_node()->list_directory($uuid, $nid, $limit, $offset);
		}
		return $directory_info;
	}

	/**
	* get user info by cache, if no cache return secret()->portal() 
	* @param 	int 	user id
	* @return 	array 	array("root", "app_nid", "user_type", "used", "capacity", "uuid")
	*/
	public function get_user_info($uid) {
		$this->memory->setCache("user");
		$this->memory->eraseExpired();
		if(!$user_info = $this->memory->retrieve($uid)) {
			return $this->get_secret()->portal($uid, $from="www.jue.so", $token=md5(rand(111111, 99999)));
		}
		return $user_info;
	}

	public function get_access_token(){
		$this->memory->setCache("auth");
		$this->memory->eraseExpired();
		if(!$oauth = $this->memory->retrieve("auth")) {
			$this->auth->get_access_token("password");
			$oauth = $this->memory->retrieve("auth");
		}
		return $oauth;
	}

	/**
	* @return 	class 	Auth()
	*/
	public function get_auth() {
		if(!isset($this->auth)) $this->auth = new Auth();
		return $this->auth;
	}

	/**
	* @return 	class 	File()
	*/
	public function get_file() {
		if(!isset($this->file)) $this->file = new File();
		return $this->file;
	}

	/**
	* @return 	class 	Node()
	*/
	public function get_node() {
		if(!isset($this->node)) $this->node = new Node();
		return $this->node;
	}

	/**
	* @return 	class 	User()
	*/
	public function get_user() {
		if(!isset($this->user)) $this->user = new User();
		return $this->user;
	}

	/**
	* @return 	class 	Secret()
	*/
	public function get_secret() {
		if(!isset($this->secret)) $this->secret = new Secret();
		return $this->secret;
	}

	/**
	* @return 	class 	Cloud()
	*/
	public function get_cloud() {
		if(!isset($this->cloud)) $this->cloud = new Cloud();
		return $this->cloud;
	}

	/**
	* @return 	class 	Memory()
	*/
	public function get_cache($param) {
		return new Memory($param);
	}
}









