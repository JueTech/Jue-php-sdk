<?php
/**
* @package     /src/Jue/Storage/Cloud
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/
 
namespace Jue\Storage;

use Jue;
use Jue\Config;
use Jue\Http\Client;

class Cloud implements CloudInterface{
	function __construct(){
		$TokenClass = new Token();
		$this->access_token = $TokenClass->get_access_token();
	}

	public function get_upload_token($uuid){
		$data = array(
			"access_token" => $this->access_token, 
			"uuid" => $uuid,
		);
		$url = Config::API_RESOURCE."/secret/get_upload_token";
		$response = Client::post($url, $data, array());
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