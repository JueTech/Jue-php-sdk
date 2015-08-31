<?php
/**
* @package     /src/Jue/Storage/OauthInterface
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.12
**/

namespace Jue\Auth;

interface AuthInterface{

	public function get_access_token($type, $scope);

	/*
	private function client_credentials($scope);
	private function password_credentials($scope);
	*/
}