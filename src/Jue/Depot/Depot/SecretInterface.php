<?php
/**
* @package     /src/Jue/Storage/SecretInterface
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/

namespace Jue\Depot;

interface SecretInterface{
	public function connect_plat_form($user, $pass, $email, $portrait, $from, $token);
}