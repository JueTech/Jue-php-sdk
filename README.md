# Jue Resource SDK for PHP

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Build Status](https://travis-ci.org/qiniu/python-sdk.svg)](https://github.com/grasses/Jue-php-sdk)
[![Code Coverage](https://scrutinizer-ci.com/g/qiniu/python-sdk/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/qiniu/python-sdk/?branch=master)

<br><hr>

# Installation

**Install composer**

> $curl -sS https://getcomposer.org/installer | php

or 

> $php -r "readfile('https://getcomposer.org/installer');" | php

Composer detail see [https://getcomposer.org/doc/00-intro.md](https://getcomposer.org/doc/00-intro.md)

**Install SDK**

> $ composer install

<br><hr>

# Usage

Start new server, get access token.

```
<?php
require_once(__DIR__."/../lib/vendor/autoload.php");
use Jue\Server;

/**
* 
*/
$app_key = "test_client";
$app_secret = "testpass";

$server = new Server($app_key, $app_secret);
$token = $server->auth()->get_access_token("client_credentials");

```

Get User info, for more api information please see [http://api.jue.so/doc/](http://api.jue.so/doc/)

```
//get user info
$res_user_info = $server->user()->get_user_info(access_token, $uuid);
echo json_encode($res_user_info);
```

Get Node info, for more api information please see [http://api.jue.so/doc/](http://api.jue.so/doc/)

```
$res_list_directory = $server->node()->list_directory($uuid, $nid);
$res_list_file  = $server->node()->list_file($uuid, $nid);
$res_list_node = $server->node()->list_node($uuid, $nid);
$res_get_node = $server->node()->get_node($uuid, $nid);

//return json format data
echo json_encode($res_list_directory);

```

Get file resource, for more api information please see [http://api.jue.so/doc/](http://api.jue.so/doc/)

```
$res_share_file = $server->file()->share_file($uuid, $fid);
$res_delete_file  = $server->file()->delete_file($uuid, 12345);
$res_delete_files = $server->file()->delete_files($uuid, "121,122,123,124,125,126,127,128");

$to_node_id = 3;
$res_move_file = $server->file()->move_file($uuid, $to_node_id, $fid);
$res_move_files = $server->file()->move_files($uuid, $to_node_id, "121,122,123,124,125,126,127,128");
$res_get_file = $server->file()->get_file($uuid, $fid);
$res_rename_file = $server->file()->rename_file($uuid, "new_name", $fid);

//return json format data
echo json_encode($res_get_file);
```


return json format data. 


<br><hr>

# Associate

Jue API please see [http://api.jue.so/doc/](http://api.jue.so/doc/)

Jue API test platform please see [http://api.jue.so/oauth2/api](http://api.jue.so/oauth2/api)

Jue Oauth platoform please see [http://homeway.me/2015/06/29/build-oauth2-under-codeigniter/](http://homeway.me/2015/06/29/build-oauth2-under-codeigniter/)

<br><hr>

# License

This library is under the MIT license. For the full copyright and license information, please view the LICENSE file that was distributed with this source code.

[https://github.com/grasses/Jue-php-sdk/LICENSE](https://github.com/grasses/Jue-php-sdk/blob/master/LICENSE)
