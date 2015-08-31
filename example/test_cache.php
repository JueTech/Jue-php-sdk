<?php

require_once(__DIR__."/../vendor/autoload.php");
use Jue\Server;

$app_key = "testclient";
$app_secret = "testpass";

$server = new Server($app_key, $app_secret);

$c = $server->cache();

$c->store(md5(rand(1111111, 9999999)), array(
	'description' => 'Movies on TV',
	'action' => array(
		'Tropic Thunder',
		'Bad Boys',
		'Crank'
		)
	), 3600
);

$c->store(md5(rand(1111111, 9999999)), array(
	'description' => 'Movies on TV',
	'action' => array(
		'Tropic Thunder',
		'Bad Boys',
		'Crank'
		)
	), 3600
);

//$c->eraseExpired();
$result = $c->retrieve('movies');

//var_dump($c->getCacheDir());
var_dump($result);

?>
