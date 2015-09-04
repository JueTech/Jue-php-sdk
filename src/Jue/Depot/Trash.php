<?php
/**
* @package     /src/Jue/Depot/Trash
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

class Trash implements TrashInterface{
	function __construct(){
		$this->memory = new Memory("trash");
	}

	

}