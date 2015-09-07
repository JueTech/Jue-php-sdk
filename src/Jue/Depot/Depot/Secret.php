<?php
/**
* @package     /src/Jue/Storage/Secret
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/
 
namespace Jue\Depot;

use Jue;
use Jue\Config;
use Jue\Auth\Token;
use Jue\Http\Client;
use Jue\Storage\Memory;

class Secret implements SecretInterface{
	
	function __construct(){
		$this->memory = new Memory("user");
	}

	public function connect_plat_form($user, $pass, $email, $portrait, $from, $token){
		$data = array(
			"client_id"=> ACCESS_KEY,
			"client_secret" => ACCESS_SECRET,
			"access_token" => ACCESS_TOKEN,
			"user" => $user,
			"pass" => $pass,
			"email" => $email,
			"portrait" => $portrait,
			"from" => $from,
			"token" => $token,
		);
		$url = Config::API_RESOURCE."/secret/connect_plat_form";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	public function portal($uid, $from="jue.so", $token=""){
		$data = array(
			"client_id"=> ACCESS_KEY,
			"client_secret" => ACCESS_SECRET,
			"access_token" => ACCESS_TOKEN,
			"uid" => $uid,
			"from" => $from,
			"token" => $token,
		);

		$url = Config::API_RESOURCE."/secret/portal";
		$response = Client::post($url, $data, array());
		
		//save user info to cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			if($body["code"] == 1000){
				$this->memory->store($uid, $body, Config::EXPIRED_LONG);
			}
			return $body;
		}

		if ($response->json() != null) {
            return array($response->json(), null);
        }
        return array($response->body, null);
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
















