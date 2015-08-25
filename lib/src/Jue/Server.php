<?php
/**
* @package     /src/Jue/oauth
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/

namespace Jue;
 
use Jue;
use Jue\Config;
use Jue\Storage\File;
use Jue\Storage\Node;
use Jue\Storage\User;
use Jue\Storage\Secret;
use Jue\Auth\Auth;

class Server{
	function __construct($access_key = Config::ACCESS_KEY, $access_secret = Config::ACCESS_SECRET){
		if(!isset($_SESSION)) {
			session_set_cookie_params(3600);
			session_start();
		}
		define("ACCESS_KEY", $access_key);
		define("ACCESS_SECRET", $access_secret);
	}

	public function auth(){
		if(!isset($this->auth)) $this->auth = new Auth();
		return $this->auth;
	}

	public function file(){
		if(!isset($this->file)) $this->file = new File();
		return $this->file;
	}

	public function node(){
		if(!isset($this->node)) $this->node = new Node();
		return $this->node;
	}

	public function user(){
		if(!isset($this->user)) $this->user = new User();
		return $this->user;
	}

	public function secret(){
		if(!isset($this->secret)) $this->secret = new Secret();
		return $this->secret;
	}
}