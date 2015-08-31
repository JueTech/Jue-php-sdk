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
                $result = "";
                foreach ($body as $key => $value) {
                    if(is_array($value)) $result = $result.$key."=".json_encode($value)."&";
                    else $result = $result.$key."=".$value."&";
                }
                $body = rtrim($result, "&");
            }
        }else{
            $headers["Content-Type"] = "application/x-www-form-urlencoded";
            if(is_array($body)){
                $result = "";
                foreach ($body as $key => $value) {
                    if(is_array($value)) $result = $result.$key."=".json_encode($value)."&";
                    else $result = $result.$key."=".$value."&";
                }
                $body = rtrim($result, "&");
            }
        }

        $this->body = $body;
        $this->method = strtoupper($method);
        $this->url = $url;
        $this->headers = $headers;
    }
}