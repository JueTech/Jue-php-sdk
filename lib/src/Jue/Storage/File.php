<?php
/**
* @package     /src/Jue/Storage/file
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/
 
namespace Jue\Storage;

use Jue;
use Jue\Config;
use Jue\Auth\Token;
use Jue\Http\Request;
use Jue\Http\Client;
use Jue\Http\Error;
use Jue\Http\Response;

class File implements FileInterface{

	function __construct(){
		$TokenClass = new Token();
		$this->access_token = $TokenClass->get_access_token();
	}

	public function share_file($uuid, $fid){
		$data = array(
			"access_token" => $this->access_token, 
			"uuid" => $uuid,
			"fid" => $fid,
		);

		$url = Config::API_RESOURCE."/file/share_file";
		$response = Client::post($url, $data, array("Content-Type" => "application/x-www-form-urlencoded"));
		return $this->do_result($response);
	}

	public function delete_file($uuid, $fid){
		$data = array(
			"access_token" => $this->access_token, 
			"uuid" => $uuid,
			"fid" => $fid,
		);

		$url = Config::API_RESOURCE."/file/delete_file";
		$response = Client::post($url, $data, array("Content-Type" => "application/x-www-form-urlencoded"));
		return $this->do_result($response);
	}

	public function delete_files($uuid, $fids){
		$data = array(
			"access_token" => $this->access_token, 
			"uuid" => $uuid,
			"fids" => $fids,
		);

		$url = Config::API_RESOURCE."/file/delete_files";
		$response = Client::post($url, $data, array("Content-Type" => "application/x-www-form-urlencoded"));
		return $this->do_result($response);
	}

	public function move_file($uuid, $to_nid, $fid){
		$data = array(
			"access_token" => $this->access_token, 
			"uuid" => $uuid,
			"fid" => $fid,
			"to_nid" => $to_nid,
		);

		$url = Config::API_RESOURCE."/file/move_file";
		$response = Client::post($url, $data, array("Content-Type" => "application/x-www-form-urlencoded"));
		return $this->do_result($response);
	}

	public function move_files($uuid, $to_nid, $fids){
		$data = array(
			"access_token" => $this->access_token, 
			"uuid" => $uuid,
			"to_nid" => $to_nid,
			"fids" => $fids,
		);

		$url = Config::API_RESOURCE."/file/move_files";
		$response = Client::post($url, $data, array("Content-Type" => "application/x-www-form-urlencoded"));
		return $this->do_result($response);
	}

	public function get_file($uuid, $fid){
		$data = array(
			"access_token" => $this->access_token, 
			"uuid" => $uuid,
			"fid" => $fid,
		);

		$url = Config::API_RESOURCE."/file/get_file";
		$response = Client::post($url, $data, array("Content-Type" => "application/x-www-form-urlencoded"));
		return $this->do_result($response);
	}

	public function rename_file($uuid, $name, $fid){
		$data = array(
			"access_token" => $this->access_token, 
			"uuid" => $uuid,
			"fid" => $fid,
			"name" => $name,
		);

		$url = Config::API_RESOURCE."/file/rename_file";
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









