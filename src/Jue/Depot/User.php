<?php
/**
* @package     /src/Jue/Depot/User
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.08.31
**/
 
namespace Jue\Depot;

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
	}

	public function get_user_info($uuid){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
		);
		
		$url = Config::API_RESOURCE."/user/get_user_info";
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









