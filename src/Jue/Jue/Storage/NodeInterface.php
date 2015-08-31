<?php
/**
* @package     /src/Jue/Storage/NodeInterface
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/

namespace Jue\Storage;

interface NodeInterface{

	public function list_file($uuid, $nid);
	public function list_directory($uuid, $nid);
	public function list_node($uuid, $nid);
	public function get_node($uuid, $nid);
}