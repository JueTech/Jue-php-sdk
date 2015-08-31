<?php
/**
* @package     /src/Jue/Storage/CloudInterface
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/

namespace Jue\Storage;

interface CloudInterface{
	public function get_upload_token($uuid);
	public function get_download_url($uuid, $fid);
}