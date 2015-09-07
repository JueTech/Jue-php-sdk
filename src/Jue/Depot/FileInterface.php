<?php
/**
* @package     /src/Jue/Storage/NodeInterface
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/

namespace Jue\Depot;

interface FileInterface{
	/**
	 * copy files to node
	 * @param	int		$to_id		node id
	 * @param	array	$fids 		file id, in array
	 * @return 	array 	array("id")	=> copy id
	*/
	public function copy_files($uuid, $fids, $to_nid);

	/**
	 * get file info
	 * @param	int		$fid		file id
	 * @return 	array 	array("id")	file data
	*/
	public function get_file($uuid, $fid);

	/**
	 * rename file
	 * @param	int		$fid		file id
	 * @param	string	$name		new file name
	 * @return 	array 	array(true/false)	boolean
	*/
	public function rename_file($uuid, $fid, $name);

	/**
	 * batch move file and node to root
	 * @param	array	$ids		array(fid, nid) 	=> 	[[2, 4, 6],[1, 3, 5, 7, 9]]
	 * @param	int 	$to_nid 	move to node id
	 * @return 	array 	array(fid, nid)	 successed id
	*/
	public function batch_move_to_root($uuid, array $ids);

	/**
	 * batch move file and node to node
	 * @param	array	$ids		array(fid, nid) 	=> 	[[2, 4, 6],[1, 3, 5, 7, 9]]
	 * @return 	array 	array(fid, nid)	 successed id
	*/
	public function batch_move_to_node($uuid, $ids, $to_nid);

	/**
	* get thumb url, return url
	* @param	string	$d  => thumb data like: "/2/w/128/h/128/q/85" => for more see qiniu.com: http://developer.qiniu.com/docs/v6/api/reference/fop/image/imageview2.html
	* @param  	string 	$id => file id
	* @return 	qiniu download url
	*/
	public function get_thumb_url($uuid, $fid, $format="/2/w/128/h/128/q/85");

	/**
	* batch get thumb url, return url
	* @param	string	$d  get => thumb data like: "/2/w/128/h/128/q/85" => for more see qiniu.com: http://developer.qiniu.com/docs/v6/api/reference/fop/image/imageview2.html
	* @param  	array 	$fids post => file ids
	* @return 	qiniu download url array([])
	*/
	public function batch_get_thumb_url($uuid, $fids, $format="/2/w/128/h/128/q/85");

	/**
	* get thumb url, return url
	* @param	string	$d => thumb data like: "/2/w/128/h/128/q/85" => for more see qiniu.com: http://developer.qiniu.com/docs/v6/api/reference/fop/image/imageview2.html
	* @param  	string 	$id => file id
	* @return 	redirect to download url
	*/
	public function redirect_thumb($uuid, $fid, $format="/2/w/128/h/128/q/85");

	/**
	* delete file directly, no limit file type
	* @param $fids 	array 	delete file id in array
	* @return 	array 	array(true/false)
	*/
	public function delete_files($uuid, array $fids = array());

	/**
	* move files to app root
	* @param  $fids array  to move file id, [2,3,4,5,6,7,8] type in file or mask
	* @return array array(true/false)
	*/
	public function move_files_to_app($uuid, array $fids = array());

}