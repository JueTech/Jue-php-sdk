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
		$this->memory = new Memory("cloud");
	}

	/**
	* qiniu upload token, return array("param", "upload_token"), param = ase 128 encryption
	* @param $parnet 			int 	=> 	save to node id
	* @param $save_to_root 		bool	=> 	save to root, if save_to_root, then $parent is no use
	* @return 	array("param", "upload_token")  => param => aes-128 encryption
	*/
	public function get_upload_token($uuid, $save_to_root=false, $parent=""){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"client_id" => Config::ACCESS_KEY,
			"uuid" => $uuid,
			"parent" => $parent,
			"save_to_root" => $save_to_root
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