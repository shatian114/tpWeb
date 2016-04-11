<?php
$redis = new Redis();
//$redis->connect('127.0.0.1', 6379);
$redis->connect('/tmp/redis.sock');
$redisKey = $_SERVER['REMOTE_ADDR'].date('Yms');
//$redis->sAdd($redisKey, '1');
//$redis->sAdd($redisKey, '2');
//$redis->setTimeout($redisKey, 300);
var_dump($redis->sisMember($redisKey, '2'));
var_dump($redis->exists($redisKey));
//var_dump($redis->getOption());
?>