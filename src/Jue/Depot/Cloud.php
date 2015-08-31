<?php
/**
* @package     /src/Jue/Storage/Cloud
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

class Cloud implements CloudInterface{
	function __construct(){
		$this->access_token = ACCESS_TOKEN;
	}

	public function get_upload_token($uuid, $parent=""){
		$data = array(
			"access_token" => $this->access_token, 
			"client_id" => Config::ACCESS_KEY,
			"uuid" => $uuid,
			"parent" => $parent
		);
		$url = Config::API_RESOURCE."/cloud/get_upload_token";
		$response = Client::post($url, $data, array("Content-Type" => "application/x-www-form-urlencoded"));
		return $this->do_result($response);
	}

	public function get_download_url($uuid, $fid){
		$data = array(
			"access_token" => $this->access_token,
			"uuid" => $uuid,
			"fid" => $fid
		);
		$url = Config::API_RESOURCE."/secret/get_download_url";
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