<?php
/**
* @package     /src/config.inc
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/

namespace Jue;
use Jue;

if (version_compare(PHP_VERSION, '5.9.0', '<')) {
    //throw new Exception('The SDK requires PHP version 5.4 or higher.');
}

final class Config{
		const SDK_VERSION 	= "15.07.09";
		const ACCESS_KEY  	= "testclient";
		const ACCESS_SECRET = "testpass";
		const API_HOST 		= "localhost:8085";
		const API_OAUTH 	= "http://localhost:8085/oauth2";
		const API_RESOURCE 	= "http://localhost:8085/v2";

		const REDIRCET_URI  = "http://homeway.me/";
		const USER_NAME 	= "user";
		const USER_PASS		= "pass";
	
}