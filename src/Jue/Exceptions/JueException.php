<?php
/**
* @package     /src/Jue/Exceptions/JueExcept
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.09.08
**/

namespace Jue\Exceptions;
use Jue\Logger\Logger;

date_default_timezone_set('Asia/Shanghai');

class JueException extends \Exception{
	/**
	* for realse or develop
	*/
	private $release = false;
	
	protected $logger = NULL;

	function __construct($message, $object){
		$this->logger = new Logger();
		$this->logger->log($message, Logger::ERROR);
	}
}