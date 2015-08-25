<?php
/**
* @package     /src/Jue/Storage/User
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/
 
namespace Jue\Storage;

use Jue;
use Jue\Config;
use Jue\Http\Request;
use Jue\Http\Client;
use Jue\Http\Error;
use Jue\Http\Response;
use Jue\Auth\Token;

class User implements UserInterface{

	private $access_token;

	function __construct(){
		$TokenClass = new Token();
		$this->access_token = $TokenClass->get_access_token();
	}

	public function get_user_info($uuid){
		$data = array(
			"access_token" => $this->access_token,
			"uuid" => $uuid,
		);
		
		$url = Config::API_RESOURCE."/user/get_user_info";
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









