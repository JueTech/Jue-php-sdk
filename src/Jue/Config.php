<?php
/**
* @package     /src/config.inc
* @author      xiaocao
* @link        http://homeway.me/ 
* @copyright   Copyright(c) 2015
* @version     15.08.31
**/

namespace Jue;
use Jue;

if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    throw new Exception('The SDK requires PHP version 5.3 or higher.');
}

final class Config{
		const EXPIRED_LONG 	= 3600;
		const EXPIRED_SHORT = 60;
		const SDK_VERSION 	= "15.08.31";
		const ACCESS_KEY  	= "homeway";
		const ACCESS_SECRET = "homeway";
		const API_HOST 		= "api.jue.so";
		const API_OAUTH 	= "http://api.jue.so/oauth2/";
		const API_RESOURCE 	= "http://api.jue.so/v2";

		const REDIRCET_URI  = "http://homeway.me/";
		const USER_NAME 	= "user";
		const USER_PASS		= "pass";
}