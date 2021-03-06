<?php
/**
* @package     /src/Jue/oauth
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.17
**/

namespace Jue\Auth;

use Jue;
use Jue\Config;
use Jue\Http\Error;
use Jue\Http\Client;
use Jue\Http\Request;
use Jue\Http\Response;
use Jue\Storage\Memory;
use Jue\Exceptions;

class Auth {
	private $memory;

	function __construct($access_key = Config::ACCESS_KEY, $access_secret = Config::ACCESS_SECRET){
		$this->memory = new Memory("auth");
	}

	public function get_access_token($type = "authorization", $scope = ""){
		switch($type){
			case "client_credentials":
				return $this->client_credentials();
				break;

			case "password":
				return $this->password_credentials();
				break;

			case "authorization":
				$url = Config::API_OAUTH."Authorize/?response_type=code&client_id=".ACCESS_KEY."&redirect_uri=".Config::REDIRCET_URI."&state=".md5(time())."&scope=".$scope;
				Client::redirect($url);
				break;

			case "implicit":
				$url = Config::API_OAUTH."Authorize/?response_type=token&client_id=".ACCESS_KEY."&redirect_uri=".Config::REDIRCET_URI."&state=".md5(time())."&scope=".$scope;
				Client::redirect($url);
				break;

			default:
				throw new Exceptions\JueOauthException($scop = "Auth", $type = "Oauth", $object = $type, $expected = "string", $message = "Auth.php:49 => Unsupported Grant Type", $code = 1058);
				return array("code" => 1058, "error" => "Unsupported Grant Type", "error_description" => "Grant type \"client_credentialss\" not supported");
				break;
		}
	}

	public function authorize($type = "authorization"){
		switch($type){
			case "authorization":
				$url = Config::API_OAUTH."Authorize/?response_type=code&client_id=".ACCESS_KEY."&redirect_uri=".Config::REDIRCET_URI."&state=".md5(time())."&scope=".$scope;
				Client::redirect($url);
				break;

			case "implicit":
				$url = Config::API_OAUTH."Authorize/?response_type=token&client_id=".ACCESS_KEY."&redirect_uri=".Config::REDIRCET_URI."&state=".md5(time())."&scope=".$scope;
				Client::redirect($url);
				break;
			default:
				throw new Exceptions\JueOauthException($scop = "Auth", $type = "Oauth", $object = $type, $expected = "string", $message = "Auth.php:68 => Unsupported Grant Type", $code = 1058);
				return array("code" => 1058, "error" => "Unsupported Grant Type", "error_description" => "Grant type \"client_credentialss\" not supported");
				break;
		}
	}

	private function client_credentials(){
		$data = array(
			"grant_type" => "client_credentials",
			"client_id" => ACCESS_KEY,
			"client_secret" => ACCESS_SECRET,
		);

		$url = Config::API_OAUTH."/ClientCredentials";
		$response = Client::post($url, $data, array(""));
		return $this->do_result($response);
	}

	private function password_credentials(){
		$data = array(
			"grant_type" => "password",
			"client_id" => ACCESS_KEY,
			"client_secret" => ACCESS_SECRET,
			"username"=> Config::USER_NAME,
			"password"=> Config::USER_PASS,
		);
		
		$url = Config::API_OAUTH."/PasswordCredentials";
		$response = Client::post($url, $data, array(""));
		return $this->do_result($response);
	}

	private function pick_up_token($body){
        if($object = json_decode($body) ){
        	$storage = array(
        		"scope" => $object->scope,
        		"access_token" => $object->access_token,
        		"expires_in" => $object->expires_in,
        		"token_type" => $object->token_type
        	);
        	if(array_key_exists("refresh_token", $object)) $storage["refresh_token"] = $object->refresh_token;
        	$this->memory->store("auth", $storage, ($object->expires_in)-60);
        }else{
        	throw new Exceptions\JueOauthException($scop = "Auth", $type = "Oauth", $object = $body, $expected = "object", $message = "Auth.php:110 get access_token error.");
        }
	}

	private function do_result($response){
		if($response->ok()){
			$this->pick_up_token($response->body);
			return $response->body;
		}
		if ($response->json() != null) {
            return array($response->json(), null);
        }
        return array($response->body, null);
	}
}
