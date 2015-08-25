<?php
/**
* @package     /src/Jue/Http/Error
* @author      xiaocao
* @link        http://homeway.me/
* @copyright   Copyright(c) 2015
* @version     15.07.09
**/

namespace Jue\Http;

final class Error {
    private $url;
    private $response;

    public function __construct($url, $response) {
        $this->url = $url;
        $this->response = $response;
    }

    public function code() {
        return $this->response->statusCode;
    }

    public function getResponse() {
        return $this->response;
    }

    public function message() {
        return $this->response->error;
    }
}
