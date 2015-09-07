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


class OauthException extends JueException{

	private $message_type = 'DEBUG';

	function __construct($object_name, $object, $expected, $message = '', $code = 0){
		$received_type = gettype($object);
        $message = "Wrong Type: $object_name, Expected $expected, received $received_type";
        $this->debug_dump($message, $object);

        parent::__construct($message, $code);
	}

	private function debug_dump(&$message, &$object) {
		if ($this->message_type == 'DEBUG') {
			ob_start();
			var_dump($object);
			$message = $message . " Debug Info: " . ob_get_clean();
		}
	}
}