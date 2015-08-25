<?php
/**
* @package     /src/Jue/Storage/Secret
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/
 
namespace Jue\Storage;

use Jue;
use Jue\Config;
use Jue\Auth\Token;
use Jue\Http\Client;

class Secret implements SecretInterface{
	function __construct(){
		$TokenClass = new Token();
		$this->access_token = $TokenClass->get_access_token();
	}

	public function connect_plat_form($user, $pass, $email, $portrait, $from, $token){
		$data = array(
			"client_id"=> ACCESS_KEY,
			"client_secret" => ACCESS_SECRET,
			"access_token" => $this->access_token,
			"user" => $user,
			"pass" => $pass,
			"email" => $email,
			"portrait" => $portrait,
			"from" => $from,
			"token" => $token,
		);
		$url = Config::API_RESOURCE."/secret/connect_plat_form";
		$response = Client::post($url, $data, array("Content-Type" => "application/x-www-form-urlencoded"));
		return $this->do_result($response);
	}

	public function portal($uid, $from="jue.so", $token=""){
		$data = array(
			"client_id"=> ACCESS_KEY,
			"client_secret" => ACCESS_SECRET,
			"access_token" => $this->access_token,
			"uid" => $uid,
			"from" => $from,
			"token" => $token,
		);

		$url = Config::API_RESOURCE."/secret/portal";
		$response = Client::post($url, $data, array("Content-Type" => "application/x-www-form-urlencoded"));
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