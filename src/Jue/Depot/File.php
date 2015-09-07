<?php
/**
* @package     /src/Jue/Storage/file
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/
 
namespace Jue\Depot;

use Jue;
use Jue\Config;
use Jue\Http\Client;
use Jue\Storage\Memory;

class File implements FileInterface{

	function __construct(){
		$this->memory = new Memory("file");
	}

	/**
	 * copy files to node
	 * @param	int		$to_id		node id
	 * @param	array	$fids 		file id, in array
	 * @return 	array 	array("id")	=> copy id
	*/
	public function copy_files($uuid, $fids, $to_nid){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"fids" => $fids,
			"to_nid" => $to_nid,
		);

		$url = Config::API_RESOURCE."/file/copy_files_with_data";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	/**
	 * get file info
	 * @param	int		$fid		file id
	 * @return 	array 	array("id")	file data
	*/
	public function get_file($uuid, $fid){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"fid" => $fid,
		);

		$url = Config::API_RESOURCE."/file/get_file";
		$response = Client::post($url, $data, array());

		//save cache
		if($response->ok()){
			$body = json_decode($response->body, true);
			if($body["code"] == 1000){
				$this->memory->setCache("file-".$uuid);
				$this->memory->store("{$uuid}_get_file_{$fid}", $body, Config::EXPIRED_SHORT);
			}
			return $body;
		}
		return $this->do_result($response);
	}

	/**
	 * rename file
	 * @param	int		$fid		file id
	 * @param	string	$name		new file name
	 * @return 	array 	array(true/false)	boolean
	*/
	public function rename_file($uuid, $fid, $name){
		$name = preg_replace('/[^[0-9a-zA-Z.-_\x{4e00}-\x{9fa5}]]*/u', "", $name);
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"fid" => $fid,
			"name" => $name
		);

		$url = Config::API_RESOURCE."/file/rename_file";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);		
	}

	/**
	 * batch move file and node to root
	 * @param	array	$ids		array(fid, nid) 	=> 	[[2, 4, 6],[1, 3, 5, 7, 9]]
	 * @param	int 	$to_nid 	move to node id
	 * @return 	array 	array(fid, nid)	 successed id
	*/
	public function batch_move_to_root($uuid, array $ids = array()){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"ids" => $ids,
		);

		$url = Config::API_RESOURCE."/file/batch_move_to_root";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);	
	}

	/**
	 * batch move file and node to node
	 * @param	array	$ids		array(fid, nid) 	=> 	[[2, 4, 6],[1, 3, 5, 7, 9]]
	 * @return 	array 	array(fid, nid)	 successed id
	*/
	public function batch_move_to_node($uuid, $ids, $to_nid){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"ids" => $ids,
			"to_nid" => $to_nid,
		);

		$url = Config::API_RESOURCE."/file/batch_move_to_node";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	/**
	* get thumb url, return url
	* @param	string	$d  => thumb data like: "/2/w/128/h/128/q/85" => for more see qiniu.com: http://developer.qiniu.com/docs/v6/api/reference/fop/image/imageview2.html
	* @param  	string 	$id => file id
	* @return 	qiniu download url
	*/
	public function get_thumb_url($uuid, $fid, $format="/2/w/128/h/128/q/85"){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"fid" => $fid,
		);
		$url = Config::API_RESOURCE."/file/get_thumb_url?d={$format}";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	/**
	* batch get thumb url, return url
	* @param	string	$d  get => thumb data like: "/2/w/128/h/128/q/85" => for more see qiniu.com: http://developer.qiniu.com/docs/v6/api/reference/fop/image/imageview2.html
	* @param  	array 	$fids post => file ids
	* @return 	qiniu download url array([])
	*/
	public function batch_get_thumb_url($uuid, $fids, $format="/2/w/128/h/128/q/85"){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
			"fids" => $fids
		);
		$url = Config::API_RESOURCE."/file/batch_get_thumb_url?&d={$format}";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	/**
	* get thumb url, return url
	* @param	string	$d => thumb data like: "/2/w/128/h/128/q/85" => for more see qiniu.com: http://developer.qiniu.com/docs/v6/api/reference/fop/image/imageview2.html
	* @param  	string 	$id => file id
	* @return 	redirect to download url
	*/
	public function redirect_thumb($uuid, $fid, $format="/2/w/128/h/128/q/85"){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"uuid" => $uuid,
		);
		$url = Config::API_RESOURCE."/file/get_thumb_url?id={$fid}&d={$format}";
		$response = Client::post($url, $data, array());
		
		if($response->ok()){
			$body = json_decode($response->body, true);
			if($body["code"] == 1000){
				header("Location: ".$body["data"]);
				exit();
			}
		}
		return $this->do_result($response);
	}

	/**
	* delete file directly, no limit file type
	* @param $fids 	array 	delete file id in array
	*/
	public function delete_files($uuid, array $fids = array()){
		$data = array(
			"access_token" => ACCESS_TOKEN, 
			"uuid" => $uuid,
			"fids" => $fids,
		);

		$url = Config::API_RESOURCE."/file/delete_files";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	/**
	* move files to app root
	* @param  $fids array  to move file id, [2,3,4,5,6,7,8] type in file or mask
	* @return array array(true/false)
	*/
	public function move_files_to_app($uuid, array $fids = array()){
		$data = array(
			"access_token" => ACCESS_TOKEN,
			"client_id" => Config::ACCESS_KEY,
			"uuid" => $uuid,
			"fids" => $fids,
		);

		$url = Config::API_RESOURCE."/file/move_files_to_app";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	public function move_file($uuid, $to_nid, $fid){
		$data = array(
			"access_token" => ACCESS_TOKEN, 
			"uuid" => $uuid,
			"fid" => $fid,
			"to_nid" => $to_nid,
		);

		$url = Config::API_RESOURCE."/file/move_file";
		$response = Client::post($url, $data, array());
		return $this->do_result($response);
	}

	public function move_files($uuid, $to_nid, $fids){
		$data = array(
			"access_token" => ACCESS_TOKEN, 
			"uuid" => $uuid,
			"to_nid" => $to_nid,
			"fids" => $fids,
		);

		$url = Config::API_RESOURCE."/file/move_files";
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









