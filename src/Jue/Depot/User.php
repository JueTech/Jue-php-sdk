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
use Jue\Http\Client;
use Jue\Storage\Memory;

class User implements UserInterface{
	function __construct(){
		$this->memory = new Memory("user");
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









