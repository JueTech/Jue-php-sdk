<?php
/**
* @package     /src/Jue/Exceptions/OauthException
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.09.08
**/

namespace Jue\Exceptions;
use Jue\Logger;


class JueOauthException extends JueException{

	private $message_type = 'DEBUG';

	function __construct($scop, $object_name, $object, $expected, $message = "", $code = 0){
		$received_type = gettype($object);
        $message = "Wrong Type: $object_name, Scope: $scop, Expected: $expected, Received: $received_type, Message: $message \n";
        $this->debug_dump($message, $object);

        parent::__construct($message, $code);
	}

	private function debug_dump(&$message, &$object) {
		switch($this->message_type){
			case "DEBUG":
				ob_start();
				print_r($object);
				$message = $message . "Debug Info: \n" . ob_get_clean();
				break;
			default:
				break;
		}
	}
}
