<?php
/**
* @package     /src/Jue/Http/Request
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.09
**/

namespace Jue\Http;

final class Request{
    public $url;
    public $headers;
    public $body;
    public $method;

    public function __construct($method, $url, array $headers = array(), $body = null) {

        if(array_key_exists("Content-Type", $headers)){
            if($headers["Content-Type"] == "application/x-www-form-urlencoded" || $headers["Content-Type"] == "application/x-www-form-urlencoded;charset=UTF-8"){
                $res = "";
                foreach ($body as $key => $value) {
                    $res = $res.$key."=".$value."&";
                }
                $body = rtrim($res, "&");
            }
        }
        $this->body = $body;
        $this->method = strtoupper($method);
        $this->url = $url;
        $this->headers = $headers;
    }
}