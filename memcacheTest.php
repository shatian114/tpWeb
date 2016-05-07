<?php
/*$mem = memcache_connect('localhost', 11211);
memcache_add($mem, 'name', 'peng', false, 0);
var_dump(memcache_get($mem, 'name'));*/
$pdo = new PDO('mysql:host=localhost;dbname=forge', 'peng', '456123');
var_dump($pdo);
?>