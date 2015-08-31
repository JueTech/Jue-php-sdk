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
	public function share_file($uuid, $fid);
	public function delete_file($uuid, $fid);
	public function delete_files($uuid, $fids);
	public function move_file($uuid, $to_nid, $fid);
	public function move_files($uuid, $to_nid, $fids);
	public function get_file($uuid, $fid);
	public function rename_file($uuid, $fid, $name);
}