<?php
/**
* @package     /src/Jue/Depot/Search
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

class Search implements SearchInterface{

	function __construct(){
		$this->memory = new Memory("search");
	}

	/**
	 * search file and node, support for waterfall, if post limit return waterfall data
	 * @param	string	$key		=> 	search key
	 * @param	int		$limit  	int 	=> select limit
	 * @param	int 	$offset  	int 	=> select offset
	 * @return 	array 	array("count", "node", "file") or waterfall array("count", "data")
	*/
	public function search_key($uuid, $key, $limit="", $offset=""){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"key" => $key,
			"limit" => $limit,
			"offset" => $offset
		);

		$url = Config::API_RESOURCE."/search/index";
		$response = Client::post($url, $data, array());
		//save cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			if($body["code"] == 1000){
				$this->memory->setCache("search-".$uuid);
				$this->memory->store("{$uuid}_search_{$key}_{$limit}_{$offset}", $body, Config::EXPIRED_SHORT);
			}
			return $body;
		}

		return $this->do_result($response);
	}

	/**
	 * search image file, with thumb, support for waterfall, if post limit return waterfall data
	 * @param	int		$limit  	int 	=> select limit
	 * @param	int 	$offset  	int 	=> select offset
	 * @return 	array 	waterfall array("count", "data")
	*/
	public function search_image($uuid, $format="/2/w/256/h/256/q/85/interlace/0", $limit="", $offset=""){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"limit" => $limit,
			"offset" => $offset,
			"d" => $format,
		);

		$url = Config::API_RESOURCE."/search/image?d=".$format;
		$response = Client::post($url, $data, array());
		//save cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			if($body["code"] == 1000){
				$this->memory->setCache("search-".$uuid);
				$this->memory->store("{$uuid}_search_image_{$limit}_{$offset}", $body, Config::EXPIRED_SHORT);
			}
			return $body;
		}
		return $this->do_result($response);
	}

	/**
	 * search doc, ppt, excel, docx, pdf, pptx, number, pages file, with download url, support for waterfall, if post limit return waterfall data
	 * @param	int		$limit  	int 	=> select limit
	 * @param	int 	$offset  	int 	=> select offset
	 * @return 	array 	waterfall array("count", "data")
	*/
	public function search_doc($uuid, $limit="", $offset=""){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"limit" => $limit,
			"offset" => $offset
		);

		$url = Config::API_RESOURCE."/search/doc";
		$response = Client::post($url, $data, array());
		//save cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			if($body["code"] == 1000){
				$this->memory->setCache("search-".$uuid);
				$this->memory->store("{$uuid}_search_doc_{$limit}_{$offset}", $body, Config::EXPIRED_SHORT);
			}
			return $body;
		}

		return $this->do_result($response);
	}

	/**
	 * search video file, with video url, support for waterfall, if post limit return waterfall data
	 * @param	int		$limit  	int 	=> select limit
	 * @param	int 	$offset  	int 	=> select offset
	 * @return 	array 	waterfall array("count", "data")
	*/
	public function search_video($uuid, $limit="", $offset=""){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"limit" => $limit,
			"offset" => $offset
		);

		$url = Config::API_RESOURCE."/search/video";
		$response = Client::post($url, $data, array());
		//save cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			if($body["code"] == 1000){
				$this->memory->setCache("search-".$uuid);
				$this->memory->store("{$uuid}_search_video_{$limit}_{$offset}", $body, Config::EXPIRED_SHORT);
			}
			return $body;
		}

		return $this->do_result($response);
	}

	/**
	 * search ai, ps file, with download url, support for waterfall, if post limit return waterfall data
	 * @param	int		$limit  	int 	=> select limit
	 * @param	int 	$offset  	int 	=> select offset
	 * @return 	array 	waterfall array("count", "data")
	*/
	public function search_source($uuid, $limit="", $offset=""){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"limit" => $limit,
			"offset" => $offset
		);

		$url = Config::API_RESOURCE."/search/source";
		$response = Client::post($url, $data, array());
		//save cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			if($body["code"] == 1000){
				$this->memory->setCache("search-".$uuid);
				$this->memory->store("{$uuid}_search_source_{$limit}_{$offset}", $body, Config::EXPIRED_SHORT);
			}
			return $body;
		}

		return $this->do_result($response);
	}

	private function do_result($response){		
		//save cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			return $body;
		}
		if ($response->json() != null) {
            return array($response->json(), null);
        }
        return array($response->body, null);
	}
}









