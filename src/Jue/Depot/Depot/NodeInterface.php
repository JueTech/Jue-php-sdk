<?php
/**
* @package     /src/Jue/Storage/NodeInterface
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/

namespace Jue\Depot;

interface NodeInterface{
	/**
	 * list user root, include node, support for waterfall
	 * @param	string	$limit 		int 	=> select limit
	 * @param	string	$offset  	int 	=> select offset
	 * @param	string	$no_cookie  bool 	=> save cookie
	 * @return 	array 	for waterfall => array(data, current, count) || for select all => array(node, file, current, count)
	 */
	public function list_directory($uuid, $nid, $limit="", $offset="");

	/**
	 * list user root, include file and node, support for waterfall
	 * @param	string	$limit 		int 	=> select limit
	 * @param	string	$offset  	int 	=> select offset
	 * @param	string	$no_cookie  bool 	=> save cookie
	 * @return 	array 	for waterfall => array(data, current, count) || for select all => array(node, file, current, count)
	 */
	public function list_root_directory($uuid, $limit="", $offset="");
	

	/**
	 * list user app, include file and node, support for waterfall
	 * @param	string	$client_id  String 	=> develop client id
	 * @param	string	$limit 		int 	=> select limit
	 * @param	string	$offset  	int 	=> select offset
	 * @param	string	$no_cookie  bool 	=> save cookie
	 * @return 	array 	for waterfall => array(data, current, count) || for select all => array(node, file, current, count)
	 */
	public function list_app_directory($uuid, $limit="", $offset="");
	

	/**
	 * rename node
	 * @param	int		$nid		node id
	 * @param	string	$name 		new name
	 * @return 	array 	array("true/false")	boolean
	*/
	public function rename_node($uuid, $nid, $name);
	
	/**
	 * add node
	 * @param	int		$pid		int 	=> node id
	 * @param	string	$name 		string 	=> node name
	 * @return 	array 	array("id")	=> insert id
	*/
	public function add_node($uuid, $pid, $name);
	
	/**
	 * list node, include node, support for waterfall
	 * @param	int		$nid		int 	=> node id
	 * @param	string	$limit 		int 	=> select limit
	 * @param	string	$offset  	int 	=> select offset
	 * @param	string	$no_cookie  bool 	=> save cookie
	 * @return 	array 	for waterfall => array(data, current, count) || for select all => array(node, file, current, count)
	*/
	public function list_node($uuid, $nid, $limit="", $offset="");
	
	/**
	 * list user app root, only include node, support for waterfall
	 * @param	string	$limit 		int 	=> select limit
	 * @param	string	$offset  	int 	=> select offset
	 * @return 	array 	for select all => array("count", "node", "file", "current") || for waterfall => array("count", "data", "app")
	 */
	public function list_app();

	/**
	* list app root node thumb url, support for waterfall 
	* @param	string	$format  => thumb data like: "/2/w/128/h/128/q/85" => for more see qiniu.com: http://developer.qiniu.com/docs/v6/api/reference/fop/image/imageview2.html
	* @param 	int 	$limit 	 => select limit, default 25
	* @param 	int 	$offset  => select offset, default 0
	*/
	public function list_app_image_file_with_thumb($uuid, $format="", $limit="", $offset="");
	
	public function list_file($uuid, $nid);
	public function get_node($uuid, $nid);
}