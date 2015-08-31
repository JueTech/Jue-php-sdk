<?php
/**
* @package     /src/auth/accesstoken
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.12
**/

namespace Jue\Auth;

class Token implements TokenInterface {
	
	public $access_token;
	public $refresh_token;

	function __construct(){

	}

	public function get_refresh_token($refresh_token = ""){
	}

	public function set_access_token($access_token){
		$this->access_token = $_SESSION["access_token"];
		$_SESSION["access_token"] = $access_token;
	}

	public function get_access_token(){
		if(isset($_SESSION["access_token"])) return $_SESSION["access_token"];
		else $this->json(2003, "Access Token error or expired.");
	}

	public function pick_up_token($data){
		//save session
        if($object = json_decode($data) ){
            if(array_key_exists("access_token", $object)){
                $_SESSION["access_token"] = $object->access_token;
                $this->access_token = $object->access_token;
            }

            if(array_key_exists("refresh_token", $object)){
                $_SESSION["refresh_token"] = $object->refresh_token;
                $this->refresh_token = $object->refresh_token;
            }
        }
	}

	private function json($code, $data){
		echo json_encode(array("code" => $code, "data" => $data));
		exit();
	}

}